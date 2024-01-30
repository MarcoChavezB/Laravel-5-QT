<!-- resources/views/child.blade.php -->
@extends('principal.app')

@section('content')
<!-- component -->
<div class=" p-6 bg-gray-100 flex items-center justify-center">
    <div class="container max-w-screen-lg mx-auto">
  
      <form action="/register" method="post">
        @csrf
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
              <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                <div class="text-gray-600">
                  <p class="font-medium text-lg">Personal Details</p>
                  <p>Please fill out all the fields.</p>
                </div>
      
                <div class="lg:col-span-2">
                  <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-5">
                      <label for="full_name">Name</label>
    
                      <input type="text" name="name" id="full_name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 @error('name') border-red-500 @enderror" placeholder="user name" value="{{ old('name') }}" />
                      @error('name')
                          <p class="text-red-500 text-xs italic">{{ $message }}</p>
                      @enderror
                                          
                    </div>
      
                    <div class="md:col-span-5">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 @error('email') border-red-500 @enderror"  value="{{ old('email') }}" placeholder="email@domain.com" />
                    @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                  @enderror
                </div>
                    <div class="md:col-span-3">
                      <label for="password">Password</label>
                      <input type="password" name="password" id="password" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 @error('password') border-red-500 @enderror" value="{{old('password')}}" placeholder="" />
                      @error('password')
                      <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                      <div class="group mt-5 ">
                        <div class="power-container"> 
                            <div id="power-point"></div> 
                        </div>  
                      </div> 
                    
                    </div>
      
                    <div class="md:col-span-2">
                      <label for="phone">Phone</label>
                      <input type="number"  name="phone" id="phone" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50 @error('phone') border-red-500 @enderror" value="{{old('phone')}}" placeholder="" />
                      @error('phone')
                      <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                    </div>
      
                    <div class="md:col-span-5">
                      <div class="inline-flex items-center">
                        <input type="checkbox" name="billing_same" id="billing_same" class="form-checkbox" checked />
                        <label for="billing_same" class="ml-2">Acepto vender mi informacion personal.</label>
                      </div>
                    </div>
      
                    <div class="md:col-span-5 text-right">
                      <div class="inline-flex items-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </form>
  
      <a target="_blank" class="md:absolute bottom-0 right-0 p-4 float-right">
        <img src="https://www.buymeacoffee.com/assets/img/guidelines/logo-mark-3.svg" alt="Buy Me A Coffee" class="transition-all rounded-full w-14 -rotate-45 hover:shadow-sm shadow-lg ring hover:ring-4 ring-white">
      </a>
    </div>
  </div>

  <script>
    let password = document.getElementById("password"); 
    let power = document.getElementById("power-point"); 
    password.oninput = function () { 
        let point = 0; 
        let value = password.value; 
        let widthPower =  
            ["1%", "25%", "50%", "75%", "100%"]; 
        let colorPower =  
            ["#D73F40", "#DC6551", "#F2B84F", "#BDE952", "#3ba62f"]; 
      
        if (value.length >= 6) { 
            let arrayTest =  
                [/[0-9]/, /[a-z]/, /[A-Z]/, /[^0-9a-zA-Z]/]; 
            arrayTest.forEach((item) => { 
                if (item.test(value)) { 
                    point += 1; 
                } 
            }); 
        } 
        power.style.width = widthPower[point]; 
        power.style.backgroundColor = colorPower[point]; 
    };
    
      </script>


<style>

  
  #top { 
      color: green; 
  } 
    
  .group { 
      width: auto; 
      text-align: center; 
  } 
    
  .group label { 
      display: block; 
      padding: 20px 0; 
  } 
    
  .group input { 
      border: none; 
      outline: none; 
      padding: 20px; 
      width: calc(100% - 40px); 
      border-radius: 10px; 
      background-color: #eaeff2; 
      color: #3ba62f; 
      font-size: 20px; 
  } 
    
  .group .power-container { 
      background-color: #e8f0fe; 
      width: 100%; 
      height: 15px; 
      border-radius: 5px; 
  } 
    
  .group .power-container #power-point { 
      background-color: #D73F40; 
      width: 1%; 
      height: 100%; 
      border-radius: 5px; 
      transition: 0.5s; 
  }
</style>
  @endsection


