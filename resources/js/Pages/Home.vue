<template>
    <div class="wrapper">
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
            <template #title
                ><a-typography-title :level="3">Все номера</a-typography-title>
            </template>
        </a-table>
    </div>
</template>

<script>
import { Table, Tag, TypographyTitle } from "ant-design-vue";
import { router } from "@inertiajs/vue3";

export default {
    components: {
        ATable: Table,
        ATag: Tag,
        ATypographyTitle: TypographyTitle,
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
    },
};
</script>

<style scoped>
.wrapper {
    padding: 20px;
}
</style>
