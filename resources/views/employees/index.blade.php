<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-messages />
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1; ?>
                                @forelse ($employees as $employee)
                                    <tr>
                                        <th>{{ $index++ }}</th>
                                        <td>{{ $employee->name }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('employees.edit', $employee->id) }}"
                                                    class="btn btn-outline-dark mx-1">Edit</a>
                                                <form action="{{ route('employees.destroy', $employee->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn btn-outline-danger">delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <br>
                                    <p class="text-center fs-6">No Requests Yet. Create one to get started!</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-items-center ">
                        <a href="{{ route('employees.create') }}" class="me-1 mt-3 btn btn-success">Add</a>
                        <a href="{{ route('requests.index') }}" class="mt-3 btn btn-success">Leave
                            Requests</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
