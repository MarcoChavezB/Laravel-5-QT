<!-- component -->
<style>
  @import url(https://pro.fontawesome.com/releases/v5.10.0/css/all.css);
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;800&display=swap');
  body {
      font-family: 'Poppins', sans-serif;
  }
  .hover\:w-full:hover {
      width: 100%;
  }
  .group:hover .group-hover\:w-full {
      width: 100%;
  }
  .group:hover .group-hover\:inline-block {
      display: inline-block;
  }
  .group:hover .group-hover\:flex-grow {
      flex-grow: 1;
  }
  </style>
  
  <div class="pt-5">
      <div class="w-full max-w-md mx-auto">
          <div class="px-7 bg-white shadow-lg rounded-2xl mb-5">
              <div class="flex">
                  <div class="flex-1 group">
                      <a href="/" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500 border-b-2 border-transparent group-hover:border-indigo-500">
                          <span class="block px-1 pt-1 pb-2">
                              <i class="far fa-home text-2xl pt-1 mb-1 block"></i>
                              <span class="block text-xs pb-1">Usuarios</span>
                          </span>
                      </a>
                  </div>
                  <div class="flex-1 group">
                      <a href="/register" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500 border-b-2 border-transparent group-hover:border-indigo-500">
                          <span class="block px-1 pt-1 pb-2">
                              <i class="far fa-compass text-2xl pt-1 mb-1 block"></i>
                              <span class="block text-xs pb-1">Registrar</span>
                          </span>
                      </a>
                  </div>
                  <div class="flex-1 group">
                      <a href="/edit" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500 border-b-2 border-transparent group-hover:border-indigo-500">
                          <span class="block px-1 pt-1 pb-2">
                              <i class="far fa-search text-2xl pt-1 mb-1 block"></i>
                              <span class="block text-xs pb-1">Modificar</span>
                          </span>
                      </a>
                  </div>
                  <div class="flex-1 group">
                      <a href="/about" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500 border-b-2 border-transparent group-hover:border-indigo-500">
                          <span class="block px-1 pt-1 pb-2">
                              <i class="far fa-cog text-2xl pt-1 mb-1 block"></i>
                              <span class="block text-xs pb-1">About</span>
                          </span>
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  