<template>
    <div class="example-component">
        <h1>{{ message }}</h1>
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: 'Hello from Vue!',
        };
    },
};
</script>

<style scoped>
.example-component {
    font-family: Arial, sans-serif;
    text-align: center;
    color: #2c3e50;
}
</style>
