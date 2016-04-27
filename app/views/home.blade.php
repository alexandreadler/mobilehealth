@extends("layout.main-mobile")


@section("content")

@stop




@section("style")

	#like {
        background: #7B7;
    }
    #like:hover {
        background: #BEB;
    }

    #unlike {
        background: #E66;
    }
    #unlike:hover {
        background: #F88;
    }

    .thumbnail {
        display: block;
        height: 120px;
    }

    .thumbnail img {
        margin: 5px !important;
    }
    .thumbnail .title {
        padding: 2px 5px 0;
        margin: 0;
        font-weight: bold;
        font-size: 0.8em
    }
    .thumbnail .desc {
        font-size: 0.7em;
        font-weight: normal;
        padding: 2px 0;
        margin: 0;
    }
    .thumbnail a {
        text-decoration: none;
        color: #000 !important;
        font-weight: normal;
    }

@stop

