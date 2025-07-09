<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css') <!-- Pastikan Tailwind sudah terinstall -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

</head>

<body class="flex items-center justify-center min-h-screen bg-cover bg-center bg-no-repeat bg-fixed"
    style="background-image: url('build/assets/backgroundlogin.png');">


    <div class="w-[645px] h-[475px] max-w-[545px] bg-[#525252]/75 pt-[40px] p-6 rounded-lg shadow-md">
        <img src="{{ asset('build/assets/logoakastra.png') }}" alt="Logo" class="w-[230px] h-[59px] mx-auto mb-4">
        <h2 class="text-[24px] font-[Inter] pt-[24px] text-center tracking-[0.5px] text-red-600 mb-4 font-bold">Akastra Admin</h2>

        @if(session('error'))
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="flex justify-center items-center">
                <div class="relative mb-4">
                    <span class="absolute inset-y-0 left-3 flex items-center text-red-600">
                        <x-heroicon-o-envelope class="w-6 h-6" />
                    </span>
                    <input type="email" name="email" placeholder="Email" class="w-[285px] pl-12 pr-4 py-2 text-green-50 placeholder-gray-200 
            bg-transparent border-0 border-b-2 border-transparent 
            focus:border-green-50 border-green-50 focus:ring-0 rounded-none focus:outline-none">
                </div>
            </div>



            <div class="flex justify-center items-center">
                <div class="relative mb-4">
                    <span class="absolute inset-y-0 left-3 flex items-center text-red-600">
                        <x-heroicon-o-lock-closed class="w-6 h-6" />
                    </span>
                    <input type="password" id="password" name="password" placeholder="Password" class="w-[285px] pl-12 pr-10 py-2 text-green-50 placeholder-gray-200 
            bg-transparent border-0 border-b-2 border-transparent 
            focus:border-green-50 border-green-50 focus:ring-0 rounded-none focus:outline-none">
                    <button type="button" onclick="togglePassword()"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-red-600">
                        <x-heroicon-o-eye id="eye" class="w-6 h-6" />
                        <x-heroicon-o-eye-slash id="eye-slash" class="w-6 h-6 hidden" />
                    </button>
                </div>
            </div>

            <!-- Remember Me Checkbox (di sebelah kiri) -->
           


            <div class="flex justify-center items-center pt-[32px]">
                <button type="submit"
                    class="w-[285px] h-[35px] bg-[#006DB0] hover:bg-blue-600 text-white rounded-lg font-semibold">
                    Login
                </button>
            </div>

        </form>

</body>
<script>
    function togglePassword() {
        var passwordInput = document.getElementById("password");
        var eyeOpen = document.getElementById("eye");
        var eyeOff = document.getElementById("eye-slash");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeOpen.classList.add("hidden");
            eyeOff.classList.remove("hidden");
        } else {
            passwordInput.type = "password";
            eyeOpen.classList.remove("hidden");
            eyeOff.classList.add("hidden");
        }
    }
</script>

</html>