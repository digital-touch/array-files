<template>
    <panel-item :field="field">
        <div slot="value" class="flex flex-row overflow-x-auto py-2">
            <p class="p-2 m-2 rounded shadow-md" v-for="file in JSON.parse(field.value)"><a :href="file.url">{{ file.editableName }}</a></p>
        </div>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>
