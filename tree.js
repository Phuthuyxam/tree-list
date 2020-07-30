const API = "http://localhost/tree-list/getdata.php";
function treeBuilder(parent, node) {
    axios.get(API + "?parent=" + parent).then(
        result => {
            let dataset = result.data;
            if (dataset === null || !dataset) return false;
            if (document.getElementById(node)) {
                document.getElementById(node).innerHTML += dataset;
                document.getElementById('ptxPluss').addEventListener('click', function () {
                    let itemArr = document.getElementsByClassName('ptx_last_child');
                    for (const item of itemArr) {
                        let dataID = item.dataset.id;
                        if (dataID) {
                            let idElement = 'treeSub-' + dataID;
                            let htmlexists = document.getElementById(idElement).querySelector('li[data-search="1"]');
                            if(htmlexists === null)
                                treeBuilder(dataID, idElement);
                        }
                    }
                    let clerElm = document.querySelectorAll('.ptx_last_child');
                    for (let index = 0; index < clerElm.length; index++) {
                        const element = clerElm[index];
                        element.classList.remove('ptx_last_child');
                    }
                });
            }
        }
    )
}
treeBuilder(0, 'ptxtreelist');

document.getElementById('ptxsearch-input').addEventListener('keyup', delay(function (e) {
    let key = this.value;
    // send request
    axios.post(API + "?find=" + key)
        .then(
            result => {
                let data = result.data;
                buildTreeSub(15);
            }
        );
}, 2000));

function delay(callback, ms) {
    let timer = 0;
    return function() {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}

function buildTreeSub(id){
    let lastNode = [];
    let itemArr = document.getElementsByClassName('ptx_last_child');
    for (const item of itemArr) {
        let dataID = item.dataset.id;
        lastNode.push(dataID);
    }
    const headers = {
        'Content-Type': 'application/json',
    }
    let bodyFormData = new FormData();
    bodyFormData.set('lastNode', JSON.stringify(lastNode));
    bodyFormData.set('idNode' , id);
    axios.post("http://localhost/tree-list/search.php", bodyFormData)
        .then(
            response => {
                let data = response.data;
                let node = 'treeSub-'+data.id;
                let dataset = data.data;
                if (document.getElementById(node)) {
                    let htmlexists = document.getElementById(node).querySelector('li[data-search="1"]');
                    if(htmlexists === null)
                        document.getElementById(node).innerHTML += dataset;
                }
                let focus = document.querySelector('li[data-id="'+ id +'"]').focus();
                console.log(focus);

            }
        )
}