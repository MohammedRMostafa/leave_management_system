<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Leave Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-messages />
                    <div class="table-responsive p-1">
                        <table class="table border table-light text-start">
                            <tr>
                                <th class="w-25">Type</th>
                                <td> {{ $request->leaveType->name }}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Description</th>
                                <td> {{ $request->description }}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Leave Date</th>
                                <td> {{ $request->leave_date_with_format }}</td>
                            </tr>
                            <tr>
                                <th class="w-25">Status</th>
                                <td> {{ $request->status }}
                                    @isset($request->reason)
                                        <br>
                                        Reason : {{ $request->reason }}
                                    @endisset
                                </td>
                            </tr>
                            <tr>
                                <th class="w-25">Action</th>
                                <td>
                                    <div class="row">
                                        @if (Auth::user()->role == 'admin')
                                            <form class="row row-cols-lg-auto g-1 align-items-center"
                                                action="{{ route('update_status') }}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="id" value="{{ $request->id }}">
                                                <div class="form-floating col-9">
                                                    <input type="text" @class(['form-control', 'is-invalid' => $errors->has('reason')]) id="reason"
                                                        name="reason" placeholder="reason"
                                                        value="{{ old('reason', $request->reason) }}">
                                                    <label for="reason">Reason</label>
                                                    <x-error field-name="reason" />
                                                </div>
                                                <button type="submit" value="approve" name="submit"
                                                    @class([
                                                        'btn btn-sm btn-outline-primary mx-1',
                                                        'is-invalid' => $errors->has('submit'),
                                                    ])>Approve</button>
                                                <button type="submit" value="deny" name="submit"
                                                    class="btn btn-sm btn-outline-danger">Deny</button>
                                                <x-error field-name="submit" />

                                            </form>
                                        @elseif (Auth::user()->role == 'employee')
                                            <div class="d-flex">
                                                <a href="{{ route('requests.edit', $request->id) }}"
                                                    class="btn btn-sm btn-outline-dark me-1">Edit</a>
                                                <form action="{{ route('requests.destroy', $request->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">delete</button>
                                                </form>
                                            </div>
                                        @endif


                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>
                    <a href="{{ route('requests.index') }}" class="btn btn-success mt-2">Home</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
