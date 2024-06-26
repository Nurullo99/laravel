<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (auth()->user()->role->name == 'manager')
                        <!-- This is an example component -->
                        <span class="text-3xl font-bold">{{ __('Applications!') }}</span>
                        <div class='mt-5 mb-5'>
                            @foreach ($aplications as $aplication)
                                <div class="rounded-xl border p-5 shadow-md w-9/12 bg-white mb-5">
                                    <div class="flex w-full items-center justify-between border-b pb-3">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]">
                                            </div>
                                            <div class="text-xl font-bold text-slate-700">{{ $aplication->user->name }}
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-8">
                                            <button
                                                class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xm font-semibold ">#
                                                {{ $aplication->id }}</button>
                                            <div class="text-xm text-neutral-500">{{ $aplication->created_at }}</div>
                                        </div>
                                    </div>

                                    <div class="mt-4 mb-6">
                                        <div class="mb-3 text-xl font-bold">{{ $aplication->subject }}</div>
                                        <div class="text-sm text-neutral-600">{{ $aplication->message }}</div>
                                    </div>

                                    <div>
                                        <div class="flex items-center justify-between text-slate-500">
                                            {{ $aplication->user->email }}

                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        {{ $aplications->links() }}
                    @elseif(auth()->user()->role->name == 'client')
                        <span class="text-3xl font-bold">{{ __('Client Form!') }}</span>
                        
                       @if (@session()->has('error'))
                  
                    <div class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
                        <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div>
                            <span class="font-medium"></span> {{ session()->get('error') }}
                        </div>
                    </div>
                    @endif
                        <div class='flex items-center '>
                            <div class='w-full max-w-lg px-10 py-8 mx-auto bg-white rounded-lg shadow-xl'>
                                <div class='max-w-md mx-auto space-y-6'>

                                    <form action="{{ route('aplications.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <h2 class="text-2xl font-bold ">Submit your application</h2>

                                        <hr class="my-6">
                                        <label class="uppercase text-sm font-bold opacity-70">Subject</label>
                                        <input name="subject" required type="text"
                                            class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">
                                        <label class="uppercase text-sm font-bold opacity-70">Message</label>
                                        <textarea required name="message" rows="4"
                                            class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none"
                                            name=""></textarea>
                                        <label class="uppercase text-sm font-bold opacity-70">File</label>
                                        <input name="file" type="file"
                                            class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none">


                                        <input type="submit"
                                            class="py-3 px-6 my-2 bg-emerald-500 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300"
                                            value="Send">
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
