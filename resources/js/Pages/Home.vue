<template>
    <div class="wrapper">
        <div class="header">
            <div class="title-wrapper">
                <a-typography-title :level="3">Все номера</a-typography-title>
            </div>
            <div class="date-inputs">
                <a-date-picker v-model="date_in" placeholder="Дата заселения" @change="handleDateInChange" />
                <a-date-picker v-model="date_out" placeholder="Дата выселения" @change="handleDateOutChange" />
                <a-button type="primary" @click="applyDates">Применить</a-button>
                <a-button danger @click="dropDates">Сбросить фильтр</a-button>
            </div>
        </div>
        
        <a-table
            :columns="columns"
            :row-key="(record) => record.key"
            :data-source="rows"
            :pagination="pagination"
            :customRow="customRowHandler"
            :scroll="{ x: 1000, y: 1000 }"
            bordered
        >
            <template #bodyCell="{ column, record }">
                <template v-if="column.key === 'number'">
                    <a @click="goToRoom(record.key)">{{ record.number }}</a>
                </template>
                <template v-if="column.key === 'airConditioner'">
                    <a-tag
                        :color="
                            record.airConditioner === 'Да' ? 'green' : 'volcano'
                        "
                        >{{ record.airConditioner }}</a-tag
                    >
                </template>
                <template v-else-if="column.key === 'TV'">
                    <a-tag :color="record.TV === 'Да' ? 'green' : 'volcano'">{{
                        record.TV
                    }}</a-tag>
                </template>
                <template v-else-if="column.key === 'balcony'">
                    <a-tag
                        :color="record.balcony === 'Да' ? 'green' : 'volcano'"
                        >{{ record.balcony }}</a-tag
                    >
                </template>
                <template v-else-if="column.key === 'forSmokers'">
                    <a-tag
                        :color="
                            record.forSmokers === 'Да' ? 'green' : 'volcano'
                        "
                        >{{ record.forSmokers }}</a-tag
                    >
                </template>
            </template>
            <!-- <template #title
                ><a-typography-title :level="3">Все номера</a-typography-title>
            </template> -->
        </a-table>
    </div>
</template>

<script>
import { Table, Tag, DatePicker, Button, TypographyTitle } from "ant-design-vue";
import { router } from "@inertiajs/vue3";

export default {
    components: {
        ATable: Table,
        ATag: Tag,
        ATypographyTitle: TypographyTitle,
        ADatePicker: DatePicker,
        AButton: Button,
    },
    props: {
        rooms: Array,
    },
    data() {
        const columns = [
            {
                title: "Номер",
                dataIndex: "number",
                key: "number",
            },
            {
                title: "Категория",
                dataIndex: "category",
                key: "category",
            },
            {
                title: "Кол-во комнат",
                dataIndex: "roomsCount",
                key: "roomsCount",
            },
            {
                title: "Кол-во мест",
                dataIndex: "seatsCount",
                key: "seatsCount",
            },
            {
                title: "Кондиционер",
                dataIndex: "airConditioner",
                key: "airConditioner",
            },
            {
                title: "Телевизор",
                dataIndex: "TV",
                key: "TV",
            },
            {
                title: "Для курящих",
                dataIndex: "forSmokers",
                key: "forSmokers",
            },
            {
                title: "Балкон",
                dataIndex: "balcony",
                key: "balcony",
            },
            {
                title: "Этаж",
                dataIndex: "floor",
                key: "floor",
            },
            {
                title: "Площадь",
                dataIndex: "area",
                key: "area",
            },
            {
                title: "Цена",
                dataIndex: "price",
                key: "price",
            },
        ];

        const rows = [];
        for (const r of this.rooms) {
            rows.push({
                key: r.room_id,
                number: r.room_id,
                category: r.name,
                roomsCount: r.count_room,
                seatsCount: r.max_capacity,
                airConditioner: r.conditioner === 1 ? "Да" : "Нет",
                TV: r.tv === 1 ? "Да" : "Нет",
                forSmokers: r.smoke === 1 ? "Да" : "Нет",
                balcony: r.balcony === 1 ? "Да" : "Нет",
                floor: r.floor,
                area: r.square,
                price: r.price,
            });
        }

        return {
            rows,
            columns,
            pagination: {
                pageSize: 12,
            },
            date_in: null,
            date_out: null,
        };
    },
    methods: {
        goToRoom(roomId) {
            router.get(`/rooms/${roomId}`);
        },
        customRowHandler(record) {
            return {
                onDblclick: () => {
                    this.goToRoom(record.key);
                },
            };
        },
        handleDateInChange(value) {
            this.date_in = value;
        },
        handleDateOutChange(value) {
            this.date_out = value;
        },
        applyDates() {            
            router.get('/', {
                date_in: this.date_in.format('YYYY-MM-DD'),
                date_out: this.date_out.format('YYYY-MM-DD'),
            });
        },
        dropDates() {
            router.get('/');
        },
    },
};
</script>

<style scoped>
.wrapper {
    padding: 20px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.date-inputs {
    display: flex;
    gap: 8px;
}
</style>
