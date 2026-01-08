
<style>
    .carte{
        display: grid;
        grid-template-columns: repeat(4,4fr);
        gap: 1rem;
        width: 100%;
    }

    .bloc{
        width: 100%;
        height: 20rem;
        background: rgb(233, 233, 210);
        overflow: hidden;
        border-radius: 2rem;
        padding: .5rem;
    }

    .img{
        width: 9rem;
        height: 9rem;
        overflow: hidden;
        border-radius: 20%;
    }

    .img img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .content h3{
        font-size: 1.2rem;
    }

    .position{
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;

    }

    .position .post{
        padding: .5rem;
        background: rgb(105, 205, 252);
    }
    .position .dep{
        padding: .5rem;
        background: rgb(186, 248, 86);
    }
    .butoncarte{
        display: flex;
        justify-content: space-between;
        margin-top: 1rem;
    }

    .button{
        display: flex;
        justify-content: end;
    }

    .butoncarte button{
        width: 8rem;
        height: 2.5rem;
    }
   
    .modal-100w {
        max-width: 80% !important;
        margin: 0;
        background: #a81212 !important;
    }

    .profil-name{
        text-align: center;
        font-size: 1.2rem

    }

    .profil-flex{
            display: flex;
            justify-content: center;
        }

     .img-profil{
        /* margin-top: 2rem; */
        width: 12rem;
        height: 12rem;
        overflow: hidden;
        border-radius: 2rem;
        /* margin: 2rem; */
        

    }

    .dialog-show{
        display:flex; justify-content:space-between;
    }

    .img-profil img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .modal-flex{
        display: flex;
        justify-content: space-between;
        margin: 1rem 2rem;
        gap: 2rem;
    }

    .modal-flex .profil{
        width: 26rem;
        background: rgb(240, 239, 239);
        margin-right: 2rem;
        overflow: hidden;
    }

    .modal-flex .detailcontent{
        width: 100%;
    }

    .profil-name{
        margin-top: 1rem;       
        font-size: 1.2rem;
        font-weight: bold;

    }

    .social{
        margin: 2rem;
        /* text-align: center; */
        
    }

    .detailcontent{
        display: flex;
        justify-content: center;
        gap: 2rem;
        flex-direction:column;
    }

    .detail-identity{
        /* border-bottom: 2rem white inset ; */
        padding: 2rem;
        width: 100%;
        display: flex;
        justify-content: center;
        background: rgb(240, 239, 239);
        border-radius: 1rem;
    }

    .detail-identity div {
        width: 25rem;
        border:2rem;

    }

    .detail-identity div .title{
        text-align: center;
        font-size : 1.5rem;
        font-weight: bold;
    }


    .id-flex{
        
        display: flex;
        justify-content: space-between;
    }

    td {
        width: 15rem;
    }

    table{
        margin-top: 2rem;
    }
   

</style>

<x-app-layout>
    

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="button">
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#createModal">Liste présence</button>
                    </div> 
                                
                     @if(session('success'))
                         <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                   
                    @endif
                               
                    @if ($employee -> isEmpty())
                        aucune employee

                    @else
                        {{ now()->format('d/m/Y') }}
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Arrivée</th>
                                    <th>Sortie</th>
                                    <th>Total heures</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employee as $e)
                                   @php
                                        $todayPointage = $e->pointages
                                            ->whereBetween('created_at', [
                                                now()->startOfDay(),
                                                now()->endOfDay()
                                        ])->first();
                                    @endphp

                                    <tr>
                                        
                                        <td class="text-center">{{ $e->id }}</td>
                                        <td>{{ $e->last_name }}</td>
                                        <td>{{ $e->first_name }}</td>

                                        {{-- ARRIVES --}}
                                        <td class="text-center">
                                           @if(!$todayPointage)
                                           {{-- Ps encore arrivée --}}
                                                <form action="{{ route('pointage.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id_employee" value="{{ $e->id }}">
                                                    <input type="hidden" name="check_in" value="{{ now()->format('H:i:s') }}">
                                                    
                                                    <button class="btn btn-success btn-sm" id="btn_arrived">Arrivée</button>
                                                </form>
                                            @else
                                            {{-- déjà arrivé --}}
                                                <span class="badge bg-primary">
                                                    {{ \Carbon\Carbon::parse($todayPointage->check_in)->format('H:i')}}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($todayPointage && is_null($todayPointage->check_out))
                                            {{-- Pas encore sortie --}}
                                                <form action="{{ route('pointage.checkout', $todayPointage->id )}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-danger btn-sm">Sortie</button>
                                                </form>
                                            
                                            @elseif ($todayPointage && $todayPointage->check_out)
                                            {{-- déjà sortie --}}
                                                <span class="badge bg-danger">
                                                    {{ \Carbon\Carbon::parse($todayPointage->check_out)->format('H:i') }}
                                                </span>
                                            @else
                                                -
                                            @endif
                                            
                                        </td>
                                        <td class="text-center">
                                            @if ($todayPointage && $todayPointage->hours_worked)
                                                <span class="badge bg-success">
                                                    {{ $todayPointage->hours_worked }} h
                                                </span>
                                                {{-- {{ dd($todayPointage->check_out) }} --}}

                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">{{ now()->format('d/m/Y') }}</td>

                                    </tr>

                                @endforeach
                                
                                    
                            </tbody>
                        </table>


                    @endif
                      
                </div>
                        
            </div>
        </div>
    </div>

    <script>
        const arrived = document.selectorById('btn_arrived');

        arrived.addEventListener("click",function(){
            alert('hello');
        });
    </script>

</x-app-layout>
