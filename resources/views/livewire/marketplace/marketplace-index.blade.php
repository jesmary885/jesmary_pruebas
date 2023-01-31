<div wire:init="loadPosts">

@if (count($marketplaces))

<div class="glider-contain">
            <ul class="glider-{{$category->id}}-{{$type}}">
            
            @foreach ($marketplaces as $marketplace)
                    
                    <li class="bg-white rounded-lg shadow {{ $loop->last ? '' : 'sm:mr-4' }}">
                    <a href="{{route('marketplace.shop',['marketplace'=>$marketplace])}}">
                    <article>
                        @if ($marketplace->images->count())
                            <figure>
                                <img class="h-52 w-full object-cover object-center" src="{{ Storage::url($marketplace->images->first()->url) }}" alt="">
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
            <p class="mt-4 font-semibold text-gray-300"> Sin publicaciones </p>
            <!-- <div class="rounded animate-spin ease duration-300 font-semibold w-10 h-10 border-2 border-gray-400"></div> -->
        </div>
@endif

@push('script')
    <script>
        Livewire.on('glider', function(id,type){
            new Glider(document.querySelector('.glider-' + id +'-' + type), {
                slidesToShow: 2, //cant de registros que se muestran
                slidesToScroll: 1, //los saltos que se dan al darle click a los botones
                draggable: true,
                dots: '.glider-' + id +'-' + type + '~ .dots', //botones pequeños
                arrows: {
                    prev: '.glider-' + id +'-' + type + '~ .glider-prev',
                    next: '.glider-' + id +'-' + type + '~ .glider-next'
                },
                //Slider responsivo
                responsive:[
                    {
                        breakpoint: 640,
                        settings:{
                            slidesToShow: 4.5, 
                            slidesToScroll: 4,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings:{
                            slidesToShow: 4.5, 
                            slidesToScroll: 4,
                        }
                    },
                    {
                        breakpoint: 1024,
                        settings:{
                            slidesToShow: 4.5, 
                            slidesToScroll: 4,
                        }
                    },
                    {
                        breakpoint: 1280,
                        settings:{
                            slidesToShow: 4.5, 
                            slidesToScroll: 4,
                        }
                    },
                ]
            });
        })
    </script>
@endpush

</div>
