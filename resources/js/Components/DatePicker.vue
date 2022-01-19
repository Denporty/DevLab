<template>
    <Label :for="name" :value="label"/>
    <flat-pickr
        v-model="modelValue"
        @change="emitEvent"
        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        :class="classname"
        :config="config"
        :placeholder="placeholder"
        :id="name"
        ref="datepicker"
    />
    <InputError :message="message"/>
</template>

<script>
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import Label from "@/Components/Label";
import InputError from "@/Components/InputError";
const French = require('flatpickr/dist/l10n/fr.js').default.fr;

export default {
    name: 'Datepicker',
    components: {
        InputError,
        Label,
        flatPickr
    },
    props: {
        'modelValue': [String, Number, Boolean],
        'name': [String],
        'label': [String],
        'classname': [String],
        'config': {
            type: Object,
            default: {
                    wrap: true, // set wrap to true only when using 'input-group'
                    altFormat: 'Y-m-d H:i:S',
                    altInput: true,
                    enableTime: true,
                    enableSeconds: true,
                    dateFormat: 'Y-m-d H:i:S',
                    locale: French, // locale for this instance only
            }
        },
        'placeholder': [String],
        'message': String
    },
    emits: ['update:modelValue'],

    methods: {
        emitEvent($event){
            this.$emit('update:modelValue', $event.target.value)
        }
    }
}
</script>
