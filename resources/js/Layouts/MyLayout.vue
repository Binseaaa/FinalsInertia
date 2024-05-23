<script setup>
    import { Link , usePage} from '@inertiajs/vue3';
    import { computed } from 'vue';

    const page = usePage()

    // const user = computed(() => page.props.user[0].name || 'Guest')
    // const tagline = computed(() => page.props.tagline)
</script>

<template>
<div id="main-wrapper" class="border-b border-gray-200 dark:border-gray-700 bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap mx-auto p-2 justify-between">
        <h1 class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">FINALS PROJECT</h1>
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400 p-2">
                <li class="me-2">
                    <Link href="/" :class="{'dark:border-green-600 dark:text-green-600': $page.component =='Landing'}" class="inline-flex items-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-green-400 hover:border-green-400 group">
                        <svg class="w-6 h-6 me-2 text-gray-600 group-hover:text-green-600 dark:group-hover:text-green-400"
                            :class="{'dark:text-green-600': $page.component === 'Landing'}"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>Home
                    </Link>
                </li>
                <li class="me-2">
                    <Link href="/creditors" :class="{'dark:border-green-600 dark:text-green-600': $page.component=='Creditors/Index'}" class="inline-flex items-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-green-400 hover:border-green-400 group">
                        <svg class="w-6 h-6 me-2 text-gray-600 group-hover:text-green-600 dark:group-hover:text-green-400" 
                        :class="{'dark:text-green-600': $page.component == 'Creditors/Index'}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                        </svg>Creditors
                    </Link>
                </li>
                <li class="me-2">
                    <Link href="/about" :class="{'dark:border-green-600 dark:text-green-600': $page.component=='About'}" class="inline-flex items-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-green-400 hover:border-green-400 group">
                        <svg class="w-6 h-6 me-2 text-gray-600 group-hover:text-green-600 dark:group-hover:text-green-400" 
                        :class="{'dark:text-green-600': $page.component == 'About'}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>About
                    </Link>
                </li>
                <li class="me-2">
                    <Link href="/" v-if="$page.props.auth.user" class="inline-flex items-center p-4 border-b-2 border-transparent rounded-t-lg group">
                        Logout
                    </Link>
                </li>
            </ul>
        </div>
    </div>
    <div id="content" class="flex flex-col flex-1">
            <div class="flex-1">
                <slot/>
            </div>
            <footer class="py-4 text-gray-500 text-center">
                Copyright &copy; 2024. Deguma Softwares, Inc.
            </footer>
        </div>
</template>


