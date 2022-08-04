<div class="row">
    @foreach($boards as $board)
        @if (is_array($board) || is_object($board))
            @include('dash.bulletin-board.board-item-card')
        @endif
    @endforeach
        <div class="d-flex">
            {!! $boards->links() !!}
        </div>
</div>


