
@extends('layouts.app')
@section('css')
    <style>
        .bgp {
            border-radius: 5px;
            color: #ffffff !important;
            font-size: 14px;
            padding: 20px 0px;
            width: 300px;
            display: block;
            cursor: pointer;
            text-align: center;
            margin: 10px
        }

        .bgp-01 {
            background-color: #b2b2b2
        }
        .bgp-02 {
            background-color: #19967d
        }
        .bgp-03 {
            background-color: #8b90ff
        }
        .bgp-04 {
            background-color: #7ab648
        }
        .bgp-05 {
            background-color: #fcc438
        }

    </style>
@endsection
@section('content')
<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <div class="panel-heading ui-sortable-handle">
        <h4 class="panel-title">Diagrama de red Actual</h4>

    </div>
    <div class="panel-body">
        @foreach($teams as $item1)
            @if ($item1->team_id == null)
                <div class="bgp bgp-01 mb-3">
                    {{ $item1->title }} <br /> {{ $item1->ip }}
                </div>
                <div style="margin-left:50px">
                    @foreach($teams as $item2)
                        @if ($item2->team_id == $item1->id )
                            <a href="https://{{ $item2->ip }}" target="_blank" class="bgp bgp-02 mb-3">
                                {{ $item2->title }} <br /> {{ $item2->ip }}
                            </a>
                            <div style="margin-left:50px">
                                @foreach($teams as $item3)
                                    @if ($item3->team_id == $item2->id )
                                        <div class="bgp bgp-03 mb-3">
                                            {{ $item3->title }} <br /> {{ $item3->ip }}
                                        </div>
                                        <div style="margin-left:50px">
                                            @foreach($teams as $item4)
                                                @if ($item4->team_id == $item3->id && $item4->group !== 0 )
                                                    <div class="bgp bgp-04 mb-3">
                                                        {{ $item4->title }} <br /> {{ $item4->ip }}
                                                    </div>
                                                    <div style="margin-left:50px">
                                                        @foreach($teams as $item5)
                                                            @if ($item5->team_id == $item4->id )
                                                                <a href="https://{{ $item5->ip }}" target="_blank" class="bgp bgp-05 mb-3">
                                                                    {{ $item5->title }} <br /> {{ $item5->ip }}
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                                @if ($item4->team_id == $item3->id && $item4->group === 0 )
                                                    <a href="https://{{ $item4->ip }}" target="_blank" class="bgp bgp-05 mb-3">
                                                        {{ $item4->title }} <br /> {{ $item4->ip }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</div>
@endsection
@section('js')
<script>
    $('#diagrams_nav').removeClass("closed").addClass("active").addClass("expand")

</script>
@endsection




