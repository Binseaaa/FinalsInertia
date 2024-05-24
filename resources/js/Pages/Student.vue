<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    const props = defineProps({
        student: Array
    })
</script>

<template>
    <AuthenticatedLayout>
        <Table>
            <thead>
                <tr>
                    <th>Id Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="student in student" :key="student.id">
                    <td>{{ student.id_num }}</td>
                    <td>{{ student.name }}</td>
                    <td>{{ student.email }}</td>
                    <td>{{ student.department }}</td>
                    <td>{{ student.status }}</td>
                    <td>...</td>
                </tr>
            </tbody>
        </Table>
    </AuthenticatedLayout>
</template>
