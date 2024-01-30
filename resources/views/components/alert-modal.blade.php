<!-- resources/views/components/error-message.blade.php -->

<div class="flex items-center p-3 w-72 h-28 bg-white rounded-md shadow-lg">
    <section class="flex justify-center items-center w-14 h-14 rounded-full shadow-md bg-gradient-to-r from-[#F9C97C] to-[#A2E9C1] hover:from-[#C9A9E9] hover:to-[#7EE7FC] hover:cursor-pointer hover:scale-110 duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" fill="#e03558" width="26" height="26" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
          </svg>
    </section>

    <section class="block border-l border-gray-300 m-3">
        <div class="pl-3">
            <h3 class="text-gray-600 font-semibold text-sm">{{ $message }}</h3>
        </div>
    </section>
</div>


