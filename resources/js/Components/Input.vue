<template>
    <Label :for="name" :value="label"/>
    <input class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:border-gray-500"
           :class="classname"
           :type="type"
           :min="min"
           :max="max"
           :step="step"
           :value="modelValue"
           @input="$emit('update:modelValue', $event.target.value)"
           ref="input"
           :list="list"
           :id="name"
           :required="required != null"
    >

    <div class="flex justify-between">
        <InputError class="w-full" :message="message"></InputError>
        <span v-if="isTypeText" class="w-full block text-xs text-right">{{ nbChar }} <span v-if="max" class="text-xs">/ {{ max }}</span> caractères</span>
    </div>
</template>

<script>
import Label from "@/Components/Label";
import InputError from "@/Components/InputError";
export default {
    components: {InputError, Label},
    props: {
        'modelValue': [String, Number, Boolean],
        'name': [String],
        'label': [String],
        'list': [String],
        'classname': [String],
        'step': [String],
        'type': {
            type: [String],
            default: 'text'
        },
        'required': {
            type: [String],
            default: null
        },
        'min': {
            type: [String, Number],
            default: null
        },
        'max': {
            type: [String, Number],
            default: null
        },
        'message': String
    },
    emits: ['update:modelValue'],
    computed:{
        nbChar(){
            if (this.modelValue == null) return 0
            return this.modelValue.length
        },
        isTypeText(){
            return this.type === 'text'
        }
    },
    methods: {
        focus() {
            this.$refs.input.focus()
        },
    },
    mounted() {
        console.log(this.classname)
    }
}
</script>
