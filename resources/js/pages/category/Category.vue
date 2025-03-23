<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, router, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
// Import icons that we'll use in the template
import { Pencil, Trash } from 'lucide-vue-next';

const categoryNameInput = ref<HTMLInputElement | null>(null);
const form = useForm({
    category_name: '',
    description: '',
    type: 'expense',
});

const saveCategory = () => {
    form.post(route('category.store'), {
        onSuccess: () => {
            form.reset();
        },
    });
};

const deleteCategory = (id: number) => {
    router.delete(route('category.destroy', id));
};

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Category',
        href: '/category',
    },
];
defineProps({
    categories: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Head title="Category" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-lg p-4 shadow">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-4">
                    <form @submit.prevent="saveCategory">
                        <div class="mb-2 grid gap-2">
                            <Label for="category_name">Name</Label>
                            <Input
                                id="category_name"
                                ref="categoryNameInput"
                                type="text"
                                v-model="form.category_name"
                                class="mt-1 block w-full"
                                autocomplete="current-password"
                                placeholder="Name"
                            />
                            <InputError :message="form.errors.category_name" />
                        </div>
                        <div class="mb-2 grid gap-2">
                            <Label for="description">Description</Label>
                            <select
                                v-model="form.type"
                                class="mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                            >
                                <option value="expense">Expense</option>
                                <option value="income">Income</option>
                            </select>
                        </div>
                        <div class="grid gap-2">
                            <Label for="description">Description</Label>
                            <textarea
                                id="description"
                                v-model="form.description"
                                placeholder="Description"
                                rows="12"
                                class="mt-1 block w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                            ></textarea>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <Button type="submit">Save</Button>
                        </div>
                    </form>
                </div>
                <div class="col-span-8">
                    <table class="min-w-full divide-y divide-gray-700">
                        <thead class="bg-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Name</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-300">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-600">
                            <tr v-for="category in categories" :key="category.id">
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ category.name }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-gray-300">{{ category.description }}</td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm {{ category.type == 'expense' ? 'text-red-500' : 'text-green-500' }}">
                                    {{ category.type }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                    <button class="rounded px-4 py-1 text-white" @click="deleteCategory(category.id)">
                                        <Trash class="text-sm hover:text-red-500" />
                                    </button>
                                    <button class="rounded px-4 py-1 text-white">
                                        <Pencil class="text-sm hover:text-gray-500" />
                                    </button>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Category content will go here -->
        </div>
    </AppLayout>
</template>
