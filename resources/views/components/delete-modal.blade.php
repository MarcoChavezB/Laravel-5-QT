<div class="modalDelete">
    <div id="popup-modal" tabindex="-1" class="">
        <div class="relative p-4 w-full max-w-md">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Está seguro de eliminar al usuario <span id="user_id"></span>?</h3>
                    <form id="deleteForm" action="/delete/" method="POST" @method("DELETE")>
                        @csrf
                        <button id="delete" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Sí, estoy seguro
                        </button>
                    </form>
                    
                    <button data-modal-hide="popup-modal" id="closeDelete" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #popup-modal{
        position: absolute;
        top: 32rem;
        left: 68rem;
        z-index: 9999;
    }
</style>

<script>
    document.getElementById('delete').addEventListener('click', function() {
        var userId = document.getElementById('user_id').innerText;
        var form = document.getElementById('deleteForm');
        form.action = '/delete/' + userId;
        form.submit();
    });
</script>
