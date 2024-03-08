@extends('layouts.app')

@section('titulo')
    Editar perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form {{ route('perfil.store')}} method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0" >
                @csrf

                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje') }}
                    </p>
                @endif
                <div class="mb-5">
                    <label
                        for="username"
                        class="mb-2 block uppercase text-gray-500 font-bold"
                    >
                        Username
                    </label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Tu Nombre de Usuario"
                        value="{{ auth()->user()->username }}"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                    />
                    @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label
                        for="username"
                        class="mb-2 block uppercase text-gray-500 font-bold"
                    >
                        Email
                    </label>
                    <input
                        type="text"
                        id="email"
                        name="email"
                        placeholder="Tu Correo de Usuario"
                        value="{{ auth()->user()->email }}"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                    />
                    @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label
                        for="imagen"
                        class="mb-2 block uppercase text-gray-500 font-bold"
                    >
                        Imagen Perfil
                    </label>
                    <input
                        type="file"
                        id="imagen"
                        name="imagen"
                        value=""
                        class="border p-3 w-full rounded-lg "
                        accept=".jpg,.jpeg, .png"
                    />
                </div>
                <div class="mb-5">
                    <label
                        for="password"
                        class="mb-2 block uppercase text-gray-500 font-bold"
                    >
                        Ingresar Passwor Anterior
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Tu Password"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label
                        for="nueva_password"
                        class="mb-2 block uppercase text-gray-500 font-bold"
                    >
                        Nueva Password
                    </label>
                    <input
                        type="password"
                        id="nueva_password"
                        name="nueva_password"
                        placeholder="Repite tu Password"
                        class="border p-3 w-full rounded-lg  @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <input
                    type="submit"
                    value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                    uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>

@endsection
