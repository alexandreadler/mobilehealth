@extends("layout.main-mobile")

@section("content")

    <script src="https://www.google.com/jsapi" type="text/javascript"></script>

	<div data-role="page" data-title="Search">

	    <div role="main" class="ui-content jqm-content jqm-fullwidth">

            <div id="searchcontrol">Loading</div>

		</div><!-- /content -->

	</div><!-- /page -->

@stop

@section("style")

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
        padding: 2px 0;
        margin: 0;
    }
    .thumbnail a {
        text-decoration: none;
        color: #000 !important;
        font-weight: normal;
    }

    .gsc-search-box, .gsc-twiddleRegionCell {
        display: none;
    }

    .gsc-control {
        width: 100% !important;
    }

@stop


@section('script')

//<!
    google.load('search', '1');

    function OnLoad() {

        // Create a search control
        var searchControl = new google.search.SearchControl();

        // Add in a full set of searchers
        var localSearch = new google.search.LocalSearch();
        searchControl.addSearcher(new google.search.WebSearch());

        // Set the Local Search center point
        localSearch.setCenterPoint("New York, NY");

        // tell the searcher to draw itself and tell it where to attach
        searchControl.draw(document.getElementById("searchcontrol"));

        searchControl.setSearchCompleteCallback(this, OnSearchComplete);

        function OnSearchComplete(sc, searcher) {

            //

        }

        // execute an inital search
        searchControl.execute('{{$q}}');

    }

    google.setOnLoadCallback(OnLoad);

    //]]>

@stop