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

        <a-calendar />

        <a-form
            :model="formState"
            layout="vertical"
            @finish="onFinish"
            class="form"
        >
            <a-input type="hidden" v-model:value="room.room_id" />
            <a-form-item label="Имя">
                <a-input type="text" v-model:value="formState.name" />
            </a-form-item>
            <a-form-item label="Фамилия">
                <a-input type="text" v-model:value="formState.surname" />
            </a-form-item>
            <a-form-item label="Отчество">
                <a-input type="text" v-model:value="formState.patronymic" />
            </a-form-item>
            <a-form-item label="Адрес">
                <a-input type="text" v-model:value="formState.address" />
            </a-form-item>
            <a-form-item label="Номер телефона">
                <a-input type="tel" v-model:value="formState.phone" />
            </a-form-item>
            <a-form-item label="Паспорт">
                <a-input type="text" v-model:value="formState.passport" />
            </a-form-item>
            <a-form-item label="Дата заезда">
                <a-input type="date" v-model:value="formState.date_in" />
            </a-form-item>
            <a-form-item label="Дата отбытия">
                <a-input type="date" v-model:value="formState.date_out" />
            </a-form-item>
            <a-space :size="8">
                <a-button html-type="submit" type="primary">Отправить</a-button>
                <a-button html-type="reset" danger>Очистить форму</a-button>
            </a-space>
        </a-form>
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
    Form,
    FormItem,
    Input,
    Button,
    Space,
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
        AForm: Form,
        AFormItem: FormItem,
        AInput: Input,
        AButton: Button,
        ASpace: Space,
    },
    data() {
        return {
            dateIn: dayjs(this.bookingDates[0].date_in),
            dateOut: dayjs(this.bookingDates[0].date_out),

            formState: {
                room_id: this.room.room_id,
                name: "",
                surname: "",
                patronymic: "",
                address: "",
                phone: "",
                passport: "",
                date_in: "",
                date_out: "",
            },
        };
    },
    methods: {
        goBack() {
            router.get("/");
        },
        onFinish() {
            router.post("/rooms", this.formState);
        },
    },
};
</script>

<style scoped>
.wrapper {
    padding: 5px 15px;
    border: 1px solid rgb(235, 237, 240);
}

.form {
    margin: 0 auto;
    max-width: 600px;
}
</style>
