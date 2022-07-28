<template>
    <Label :for="name" :value="label"/>
    <select class="appearance-none block w-full capitalize bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            :class="classname"
            @change="$emit('update:modelValue', $event.target.value)"
            :value="modelValue"
            :required="required != null"
    >
        <template v-for="(value, key) in options" :key="key">
            <option :value="value.id">{{ value.name }}</option>
        </template>
    </select>
    <InputError :message="message"></InputError>
</template>

<script>
import InputError from "@/Components/InputError";
import Label from "@/Components/Label";
export default {
    components: {Label, InputError},
    props: {
        'modelValue': [String, Number, Boolean],
        'name': [String],
        'label': [String],
        'classname': [String],
        'required': {
            type: [String],
            default: null
        },
        'default': String,
        'message': String,
        'options': Object,
    },
    emits: ['update:modelValue'],
    methods: {
        focus() {
            this.$refs.input.focus()
        },
    }
}
</script>

<style scoped>

</style>
