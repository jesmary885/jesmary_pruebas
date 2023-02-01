<div wire:init="loadPosts">

@if (count($marketplaces))

        <div class="glider-contain">
            <ul class="glider-{{$category->id}}-{{$type}}">
            
                @foreach ($marketplaces as $marketplace)
                    
                    <li class="bg-white rounded-lg shadow mr-2">
                        <a href="{{route('marketplace.shop',['marketplace'=>$marketplace])}}">
                            <article>
                                @if ($marketplace->images->count())
                                    <figure>
                                        <img class=" w-full h-52 object-cover" src="{{ Storage::url($marketplace->images->first()->url) }}" alt="">
                                    </figure>
                                @else
                                    <figure>
                                        <img class="h-52 w-full object-cover object-center"
                                        src="/storage/marketplace/no-imagen.jpg" alt="">
                                    </figure>
                                @endif
                                    

                                <div class="py-4 px-6">
                                    <h1 class="text-md font-semibold">
                                        {{$marketplace->name}}
                                    </h1>

                                    @if($marketplace->type == 'venta')
                                        <p class="font-bold text-trueGray-700">$ {{$marketplace->price}}</p>
                                    @else
                                        <p class="font-bold text-trueGray-700">Tasa: $ {{$marketplace->tasa}}</p>
                                    @endif
                                </div>
                            </article>
                        </a>
                    </li>

                @endforeach
            
            </ul>
        
            <button aria-label="Previous" class="glider-prev">«</button>
            <button aria-label="Next" class="glider-next">»</button>
            <div role="tablist" class="dots"></div>
        </div>


@else
        <div class="mb-4 h-48 flex justify-center items-center shadow-xl border border-gray-100 rounded-lg">
            <div class="rounded animate-spin ease duration-300 font-semibold w-10 h-10 border-2 border-gray-400"></div>
        </div> 

@endif



</div>
