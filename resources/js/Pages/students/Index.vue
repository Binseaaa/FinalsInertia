<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    students: Array
})

const deleteStudentId = ref(null);
const editStudent = ref(null)
const showDeleteModal = ref(false);
const showCreateModal = ref(false);
const form = useForm({
    name: '',
    email: '',
    department: '',
    status: '',
})

const toggleEditModal = (student) => {
    editStudent.value = student;
    form.name = student.name;
    form.email = student.email;
    form.department = student.department;
    form.status = student.status;
}

const toggleDeleteModal = (show, studentId = null) => {
    showDeleteModal.value = show;
    if (show) {
        deleteStudentId.value = studentId;
    } else {
        deleteStudentId.value = null;
    }
}

const delStudent = () => {
    const delForm = useForm({
        id: deleteStudentId.value
    });
    delForm.submit('delete', `/student/${deleteStudentId.value}`, {
        preserveScroll: true
    });
    toggleDeleteModal(false);
}

const toggleCreateModal = (show) => {
    showCreateModal.value = show;
    form.reset();
}

const create = async () => {
    form.post('/student', {
        onSuccess: () => toggleCreateModal(false),
        preserveScroll: true
    })
}

const submit = () => {
    form.submit('put', '/student/' + editStudent.value.id, {
        preserveScroll: true
    })
    toggleEditModal(false);
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="relative overflow-x-auto sm:rounded-lg">
            <div class="p-4 flex justify-between">
                <h1 class="text-3xl text-white">Students</h1>
                <div>
                    <Button @click="toggleCreateModal" class="bg-green-500 px-5 py-2 rounded-xl text-white text-lg hover:bg-green-400">Add</Button>
                </div>
            </div>
            <table class="w-[95vw] text-base text-left rtl:text-right text-white p-5 m-auto">
                <thead class="text-base text-gray-700 uppercase bg-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Id Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Department
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="student in students" :key="student.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ student.id_num }}
                        </th>
                        <td class="px-6 py-4">
                            {{ student.name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ student.email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ student.department }}
                        </td>
                        <td class="px-6 py-4" :class="{ 'text-green-500': student.status === 'Cleared', 'text-red-500': student.status !== 'Cleared' }">
                            {{ student.status }}
                        </td>
                        <td class="px-6 py-4">
                            <button @click="toggleEditModal(student)" class="py-2 hover:text-blue-600 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </button>
                            <button type="submit"  @click="() => toggleDeleteModal(true, student.id)" class="text-xl hover:text-red-700 text-white px-4 py-2 rounded"><svg class="w-6 h-6"  width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <line x1="4" y1="7" x2="20" y2="7" />  <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />  <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />  <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </button>
                        </td>
                    </tr>
                    </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
    <div v-if="showDeleteModal" id="delete-modal" class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <div class="dark:border-gray-700 bg-gray-900 p-8 rounded-lg shadow-lg">
        <h2 class="text-lg font-semibold mb-4 text-white">Confirm Deletion</h2>
        <p class="mb-4 text-white">Are you sure you want to delete this student?</p>
        <div class="flex justify-end">
            <button @click="delStudent" class="px-4 py-2 bg-red-600 text-white rounded-lg mr-2 hover:bg-red-900">Yes</button>
            <button @click="toggleDeleteModal(false)" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-400">No</button>
        </div>
    </div>
    </div>

        <!-- Create modal -->
        <div v-if="showCreateModal" id="crud-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <div class="relative p-4">
      <!-- Create Modal content -->
      <div class="border-b border-gray-200 dark:border-gray-700 bg-gray-900 rounded-lg shadow-lg w-max">
        <!-- Create Modal header -->
        <div class="flex items-center justify-between p-2 border-b rounded-t dark:border-gray-600">
          <h2 class="text-white p-5   text-lg font-semibold">Add Student</h2>
          <button @click="toggleCreateModal(null)" type="button" class="text-gray-400 hover:text-red-600 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Create Modal body -->
        <div>
          <form class="grid grid-cols-2 gap-2 w-5/6 mx-auto my-auto py-10" @submit.prevent="create">
            <div>
                <label for="name" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Name</label>
                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                    <input type="text" name="name" id="name" v-model="form.name" class="rounded-lg text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
                <div>
                <label for="email" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Email</label>
                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                    <input type="text" email="email" id="email" v-model="form.email" class="rounded-lg text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
                <div>
            <label for="department" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Department</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <select id="department" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.department">
                      <option value="CAST">CAST</option>
                      <option value="CABM-HM">CABM-HM</option>
                      <option value="CAST">CON</option>
                      <option value="CABM-HM">COE</option>
                      <option value="CAST">CCJ</option>
                      <option value="CABM-HM">CABM-B</option>
                    </select>
                </div>
            </div>
            <div>
            <label for="status" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Status</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <select id="status" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.status">
                      <option value="Cleared">Cleared</option>
                      <option value="Not Cleared">Not Cleared</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="col-span-2 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Student</button>
        </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Edit modal -->
    <div v-if="editStudent" id="crud-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Edit Modal content -->
      <div class="border-b border-gray-200 dark:border-gray-700 bg-gray-900 p-5 rounded-lg shadow-lg">
        <!-- Edit Modal header -->
        <div class="flex items-center justify-between p-2 border-b rounded-t dark:border-gray-600">
          <h2 class="text-lg font-semibold text-white">Edit Creditor</h2>
          <button @click="toggleEditModal(null)" type="button" class="text-gray-400 hover:text-red-600 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="crud-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Edit Modal body -->
        <div>
          <form @submit.prevent="submit">
            <div>
                <label for="name" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Name</label>
                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                    <input type="text" name="name" id="name" v-model="form.name" class="rounded-lg text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
                <div>
                <label for="email" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Email</label>
                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </div>
                    <input type="text" email="email" id="email" v-model="form.email" class="rounded-lg text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
                <div>
            <label for="department" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Department</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <select id="department" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.department">
                      <option value="CAST">CAST</option>
                      <option value="CABM-HM">CABM-HM</option>
                      <option value="CAST">CON</option>
                      <option value="CABM-HM">COE</option>
                      <option value="CAST">CCJ</option>
                      <option value="CABM-HM">CABM-B</option>
                    </select>
                </div>
            </div>
            <div>
            <label for="status" class="block mb-2 text-font-medium text-gray-900 dark:text-white">Status</label>
                <div class="relative mb-6">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <select id="status" class="text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="form.status">
                      <option value="Cleared">Cleared</option>
                      <option value="Not Cleared">Not Cleared</option>
                    </select>
                </div>
            </div>
          <button type="submit" class="bg-green-600 text-xl hover:bg-green-700 text-white mr-3 px-4 py-2 rounded">Save</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</template>
