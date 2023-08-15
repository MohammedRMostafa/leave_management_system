<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit an Employee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('employees.update', $employee->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-floating mb-3">
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('name')]) id="name" name="name"
                                placeholder="name" value="{{ old('name', $employee->name) }}">
                            <label for="name">Name</label>
                            <x-error field-name="name" />
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" @class(['form-control', 'is-invalid' => $errors->has('email')]) id="email" name="email"
                                placeholder="email" value="{{ old('email', $employee->email) }}">
                            <label for="email">Email</label>
                            <x-error field-name="email" />
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" @class(['form-control', 'is-invalid' => $errors->has('password')]) id="password" name="password"
                                placeholder="password" value="{{ old('password') }}">
                            <label for="password">Password</label>
                            <x-error field-name="password" />
                        </div>


                        <div class="d-flex col-3">
                            <button type="submit" class="me-1 btn btn-outline-primary">Edit</button>
                            <a href="{{ route('employees.index') }}" class="btn btn-outline-primary">Home</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
