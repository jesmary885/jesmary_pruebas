<div>
    
<div class="md:grid md:grid-cols-3 md:gap-6 mt-0">
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900"><p class="text-gray-100"> Información de mi cuenta</p></h3>

            <p class="mt-1 text-sm text-gray-600">
                
            </p>
        </div>

        <div class="px-4 sm:px-0">
            
        </div>
    </div>

    <div class="mt-2 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white sm:p-6 shadow-lg shadow-green-500 sm:rounded-md">
           
                <div class="flex w-full">
                    <p class="font-bold text-gray-800 mr-2">
                        Plan de pago:
                    </p>

                    <p class="font-semibold text-gray-600">
                        Cada {{$plan}} días.
                    </p>

                </div>

                <div class="flex w-full">
                    <p class="font-bold text-gray-800 mr-2">
                        Saldo en página:
                    </p>

                    <p class="font-semibold text-gray-600">
                        {{$balance}} $.
                    </p>

                </div>

                <div class="flex w-full">
                    <p class="font-bold text-gray-800 mr-2">
                        Próxima fecha de pago:
                    </p>

                    <p class="font-semibold text-gray-600">
                        {{$last_payment_date }}.
                    </p>

                </div>
            
        </div>
    </div>
</div>



</div>
