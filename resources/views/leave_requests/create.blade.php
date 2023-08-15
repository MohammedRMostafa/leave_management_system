<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Leave Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('requests.store') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <select @class(['form-select', 'is-invalid' => $errors->has('leave_type_id')]) name="leave_type_id" id="type_id">
                                <option value="">Select One</option>
                                @foreach ($types as $type)
                                    <option @selected($type->id == old('leave_type_id')) value="{{ $type->id }}">{{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="type_id">Leave Type</label>
                            <x-error field-name="leave_type_id" />

                        </div>
                        <div class="form-floating mb-3">
                            <textarea @class(['form-control', 'is-invalid' => $errors->has('description')]) id="description" name="description" placeholder="Description (Optional)">{{ old('description') }}</textarea>
                            <label for="description">Description (Optional)</label>
                            <x-error field-name="description" />
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" @class(['form-control', 'is-invalid' => $errors->has('leave_date')]) id="leave_date" name="leave_date"
                                value="{{ old('leave_date') }}">
                            <label for="leave_date">Leave Date</label>
                            <x-error field-name="leave_date" />
                        </div>

                        <div class="d-flex col-3">
                            <button type="submit" class="me-1 btn btn-outline-primary">Create</button>
                            <a href="{{ route('requests.index') }}" class="btn btn-outline-primary">Home</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
