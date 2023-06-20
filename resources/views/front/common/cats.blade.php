@inject('cats', 'App\Services\CatsService')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>All autoservices</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($cats->get() as $autoservice)
                        <li class="list-group-item">
                            <div class="list-table cats">
                                <div class="list-table__content">
                                    <a href="{{route('show-cats-mechanics', $autoservice)}}">
                                        <h3>
                                            {{$autoservice->title}}
                                            <div class=" count">[{{$autoservice->autoserviceMechanics()->count()}}]</div>
                                        </h3>
                                    </a>
                                </div>

                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No autoservices yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
