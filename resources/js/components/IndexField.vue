<template>

    <span><p v-for="file in JSON.parse(field.value)"><a :href="file.url">{{ file.originalName }}</a><br/></p><br>{{ field.value }}</span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>
