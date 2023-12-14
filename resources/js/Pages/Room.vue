<template>
    <h1>Номер - {{ room.room_id }}</h1>
    
    <div>
        <p>Категория - {{ room.name }}</p>
        <p>Кол-во комнат - {{ room.count_room }}</p>
        <p>Кол-во мест - {{ room.max_capacity }}</p>
        <p>Этаж - {{ room.floor }}</p>
        <p>Площадь - {{ room.square }}</p>
        <p>Кондиционер - 
            <span v-if="room.conditioner == 1">Есть</span>
            <span v-else>Нет</span>
        </p>
        <p>Телевизор - 
            <span v-if="room.tv == 1">Есть</span>
            <span v-else>Нет</span>
        </p>
        <p>Для курящих - 
            <span v-if="room.smoke == 1">Да</span>
            <span v-else>Нет</span>
        </p>
        <p>Балкон - 
            <span v-if="room.balcony == 1">Есть</span>
            <span v-else>Нет</span>
        </p>
        <p>Цена за ночь - {{ room.price }}</p>
    </div>
</template>

<script>
    export default {
        props: {
            room: Array,
        },
    };
</script>