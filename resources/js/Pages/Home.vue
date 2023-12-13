<template>
    <h1>Hello, {{ name }}!</h1>

    <ul>
        <li v-for="tool of stack" v-text="tool"></li>
    </ul>
</template>

<script>
    export default {
        props: {
            name: String,
            stack: Array,
        },
    };
</script>