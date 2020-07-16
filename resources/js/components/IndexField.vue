<template>
    <span><p class="p-2 m-2 rounded shadow-md" v-for="file in JSON.parse(field.value)"><a :href="file.url">{{ file.editableName }}</a></p><br>{{ field.value }}</span>
</template>

<script>
    export default {
        props: ['resourceName', 'field'],
    }
</script>
