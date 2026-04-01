<template>
    <Select @update:modelValue="onModelValueUpdate">
        <SelectTrigger>
            <SelectValue
                :placeholder="placeholder"
                v-if="placeholder"
            />
        </SelectTrigger>
        <SelectContent>
            <SelectGroup>
                <SelectItem
                    :value="option.value"
                    v-for="option in options"
                    :key="option.value"
                >
                    {{ option.label }}
                </SelectItem>
            </SelectGroup>
        </SelectContent>
    </Select>
</template>

<script setup lang="ts">
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';

defineProps<{
    placeholder?: string;
    options: Array<{ value: any; label: string }>;
}>();

const emit = defineEmits(['change']);

const onModelValueUpdate = (data: any) => {
    window.setTimeout(() => emit('change'), 100);
};
</script>

<style scoped></style>
