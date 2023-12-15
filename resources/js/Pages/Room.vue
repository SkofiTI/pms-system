<template>
    <div class="wrapper">
        <a-page-header
            class="demo-page-header"
            :title="`Номер ${room.room_id}`"
            @back="goBack"
        >
            <a-descriptions size="small" :column="3">
                <a-descriptions-item label="Категория">{{
                    room.name
                }}</a-descriptions-item>
                <a-descriptions-item label="Количество комнат">
                    {{ room.count_room }}
                </a-descriptions-item>
                <a-descriptions-item label="Количество мест">{{
                    room.max_capacity
                }}</a-descriptions-item>
                <a-descriptions-item label="Этаж">{{
                    room.floor
                }}</a-descriptions-item>
                <a-descriptions-item label="Площадь">
                    {{ room.square }} М²
                </a-descriptions-item>
                <a-descriptions-item label="Кондиционер">
                    {{ room.conditioner === 1 ? "да" : "нет" }}
                </a-descriptions-item>
                <a-descriptions-item label="Телевизор">
                    {{ room.tv === 1 ? "да" : "нет" }}
                </a-descriptions-item>
                <a-descriptions-item label="Для курящих">
                    {{ room.smoke === 1 ? "да" : "нет" }}
                </a-descriptions-item>
                <a-descriptions-item label="Балкон">
                    {{ room.balcony === 1 ? "да" : "нет" }}
                </a-descriptions-item>
                <a-descriptions-item label="Цена за ночь">
                    {{ room.price }} рублей
                </a-descriptions-item>
            </a-descriptions>
        </a-page-header>

        <a-calendar :dateFullCellRender="dateFullCellRender" />
    </div>
</template>

<script>
import { router } from "@inertiajs/vue3";
import {
    TypographyTitle,
    TypographyText,
    TypographyLink,
    PageHeader,
    Descriptions,
    DescriptionsItem,
    Calendar,
} from "ant-design-vue";

import dayjs from "dayjs";

export default {
    props: {
        room: Object,
        bookingDates: Array,
    },
    components: {
        ATypographyTitle: TypographyTitle,
        ATypographyText: TypographyText,
        ATypographyLink: TypographyLink,
        APageHeader: PageHeader,
        ADescriptions: Descriptions,
        ADescriptionsItem: DescriptionsItem,
        ACalendar: Calendar,
    },
    data() {
        return {
            dateIn: dayjs(this.bookingDates[0].date_in),
            dateOut: dayjs(this.bookingDates[0].date_out),
        };
    },
    methods: {
        goBack() {
            router.get("/");
        },
    },
};
</script>

<style scoped>
.wrapper {
    padding: 5px 15px;
    border: 1px solid rgb(235, 237, 240);
}
</style>
