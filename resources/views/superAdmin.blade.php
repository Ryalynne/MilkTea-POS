<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex mt-3">
                    <button type="button"
                        class="modalButtonRegister text-white bg-blue-500 border border-gray-300 focus:outline-none hover:bg-blue-600 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Register</button>
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400  mb-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="table-search-users"
                            class="myInput block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search for users">
                    </div>
                </div>

                <div class="relative overflow-x-auto">
                    <table class=" table w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    User Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($account as $item)
                                <tr class="bg-white border-b tr">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                        {{ $item->name }}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                        {{ $item->email }}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                        {{ $item->user_type }}
                                    </th>
                                    <td class="border px-6 py-4">
                                        <a href="#"
                                            class="modalButtonUpdate font-medium text-blue-600 hover:underline edit-link"
                                            data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                            data-email="{{ $item->email }}" data-type="{{ $item->user_type }}">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="myModal"
            class="hidden fixed inset-0 z-10 bg-gray-500 bg-opacity-75 flex justify-center items-center">
            <div class="bg-white rounded-lg shadow-lg p-8 max-h-[800px] overflow-y-auto">
                <!-- Added max-h-[400px] class for maximum height and overflow-y-auto -->
                <form method="POST" action="{{ route('Insert-User') }}">
                    @csrf
                    <div class="flex items-center justify-between w-full">
                        <h3 class="text-lg font-bold leading-6 text-gray-900 mb-2">--------- REGISTER ACOUNT
                            ------------</h3>
                        <button id="closeModal" type="button"
                            class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div id="tagsContainer" class="flex flex-wrap mt-2 max-w-[400px]"></div>
                    <div class="mb-6">
                        <label for="tagsInput" class="block mb-2 text-sm font-medium text-gray-900">USER NAME</label>
                        <input name="UserName" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required placeholder="Enter User Name">
                    </div>
                    <div class="mb-6">
                        <label for="tagsInput" class="block mb-2 text-sm font-medium text-gray-900">EMAIL</label>
                        <input name="Email" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required placeholder="Email">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">PASSWORD</label>
                        <input name="password" id="password" type="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required placeholder="Password">
                    </div>
                    <div class="mb-6">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">CONFIRM
                            PASSWORD</label>
                        <input name="password_confirmation" id="password_confirmation" type="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required placeholder="Confirm Password">
                    </div>
                    <div class="mb-6">
                        <label for="tagsInput" class="block mb-2 text-sm font-medium text-gray-900">USER TYPE</label>
                        <select name="user_type" id="tagsInput"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full max-w-lg p-2.5 bg-white">
                            <option selected>-- What Type Of User --</option>
                            <option value="SUPER ADMIN">SUPER ADMIN</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="EMPLOYEE">EMPLOYEE</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">REGISTER</button>
                </form>
            </div>
        </div>

        <div id="myModal1"
            class="hidden fixed inset-0 z-10 bg-gray-500 bg-opacity-75 flex justify-center items-center">
            <div class="bg-white rounded-lg shadow-lg p-8 max-h-[800px] overflow-y-auto">
                <!-- Added max-h-[400px] class for maximum height and overflow-y-auto -->
                <form method="POST" action="{{ route('updateUserTypeSuper') }}">
                    @csrf
                    <div class="flex items-center justify-between w-full">
                        <h3 class="text-lg font-bold leading-6 text-gray-900 mb-2">--------- UPDATE ACCOUNT
                            ------------</h3>
                        <button id="closeModal1" type="button"
                            class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div id="tagsContainer" class="flex flex-wrap mt-2 max-w-[400px]"></div>
                    <div class="mb-6 hidden">
                        <label for="tagsInput" class="block mb-2 text-sm font-medium text-gray-900">ID</label>
                        <input name="userID" type="text" id="User-ID"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter User Name">
                    </div>


                    <div class="mb-6">
                        <label for="tagsInput" class="block mb-2 text-sm font-medium text-gray-900">USER NAME</label>
                        <input name="UserName" type="text" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Enter User Name" disabled>
                    </div>
                    <div class="mb-6">
                        <label for="tagsInput" class="block mb-2 text-sm font-medium text-gray-900">EMAIL</label>
                        <input name="Email" type="text" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Email" disabled>
                    </div>

                    <div class="mb-6">
                        <label for="tagsInput" class="block mb-2 text-sm font-medium text-gray-900">USER TYPE</label>
                        <select name="user_type1" id="user_type"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full max-w-lg p-2.5 bg-white">
                            <option selected>-- What Type Of User --</option>
                            <option value="SUPER ADMIN">SUPER ADMIN</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="EMPLOYEE">EMPLOYEE</option>
                            <option value="DISABLED">DISABLED</option>
                        </select>
                    </div>
                    <button type="submit" name="removed"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">DELETE</button>

                    <button type="submit" name="update"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('./javascript/verify_password.js') }}"></script>
    <script src="{{ asset('./javascript/update_account.js') }}"></script>
    <script src="{{ asset('./javascript/register_java.js') }}"></script>
</x-app-layout>
