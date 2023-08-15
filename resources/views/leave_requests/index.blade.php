<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leave Requests') }}
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
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1; ?>
                                @forelse ($requests as $request)
                                    <tr>
                                        <th>{{ $index++ }}</th>
                                        <td>{{ $request->leaveType->name }}</td>
                                        <td>{{ $request->description }}</td>
                                        <td>{{ $request->leave_date_with_format }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('requests.show', $request->id) }}"
                                                    class="btn btn-sm btn-outline-primary">Show</a>
                                                @if (Auth::user()->role == 'employee')
                                                    <a href="{{ route('requests.edit', $request->id) }}"
                                                        class="btn btn-sm btn-outline-dark mx-1">Edit</a>
                                                    <form action="{{ route('requests.destroy', $request->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger">delete</button>
                                                    </form>
                                                @endif
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
                        @if (Auth::user()->role == 'employee')
                            <a href="{{ route('requests.create') }}" class="mt-3 btn btn-success">Add</a>
                        @else
                            <a href="{{ route('types.index') }}" class="me-1 mt-3 btn btn-success">Leave Types</a>
                            <a href="{{ route('employees.index') }}" class="mt-3 btn btn-success">Employees</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
