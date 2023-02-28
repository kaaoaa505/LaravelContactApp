<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <form id="search_form">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <div class="input-group mb-3">
                        <input type="text" id="search_txt" name="search" value="{{ request('search') }}"
                            class="form-control" placeholder="Search..." aria-label="Search..."
                            aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button type="button" id="reset_btn" class="btn btn-outline-secondary">
                                <i class="fa fa-refresh"></i>
                            </button>
                            <button id="search_btn" class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
