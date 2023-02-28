let filter_company_id = document.getElementById("filter_company_id");
if (filter_company_id) {
    filter_company_id.addEventListener("change", function () {
        let companyId = this.value || this.options[this.selectedIndex].value;
        window.location.href =
            window.location.href.split("?")[0] + "?company_id=" + companyId;
    });
}

var reset_btn = document.getElementById("reset_btn");
if(reset_btn){
    reset_btn.addEventListener('click', function(){
        let search_txt = document.getElementById('search_txt');
        search_txt.value = '';

        let filter_company_id = document.getElementById('filter_company_id');
        
        if(filter_company_id)
            filter_company_id.selectedIndex = '';

        window.location.href = window.location.href.split('?')[0];
    });
}

const toggleClearBtn = () => {
    let query = location.search,
    pattern = /[?&]search/, // MATCH: ?search= OR ?company_id=123&search=
    reset_btn = document.getElementById('reset_btn');

    if(reset_btn){
        if(pattern.test(query)){
            reset_btn.style.display = 'block';
        }else{
            reset_btn.style.display = 'none';
        }
    }
};
toggleClearBtn();