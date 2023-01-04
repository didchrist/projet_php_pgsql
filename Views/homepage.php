<section class="section-form">
    <?php if (isset($_SESSION['user']) and isset($_SESSION['password'])): ?>
    <div class="form-titre">
        <h2>Ajouter un utilisateur</h2>
    </div>
    <div id="message" class="error-box message-box">
    </div>
    <div class="modal" id="myModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="" method="POST">
                <div>
                    <div>
                        <input type="checkbox" name="superuser">
                        <label for="privilege">SuperUser</label>
                    </div>
                    <div>
                        <input type="checkbox" name="allowAddUser">
                        <label for="allowAddUser">Création d'utilisateur</label>
                    </div>
                </div>
                <ul>
                    <li><a id="article" class="active" href="#">Article</a></li>
                    <li><a id="client" href="#">Client</a></li>
                    <li><a id="commande" href="#">Commande</a></li>
                </ul>
                <div id="content"></div>
            </form>
        </div>
    </div>
    <form action="" method="POST" onsubmit="addUser(event, this)">
    <div class="form-input">
            <label for="username">Pseudonyme : </label>
            <input type="text" name="username" placeholder="Testo">
        </div>
        <div class="form-input">
            <label for="password">Mot de passe : </label>
            <input type="password" name="password" placeholder="*****">
        </div>
        <div class="div-button">
            <button id="myBtn" type="submit">Inscrire</button>
        </div>
    </form>
    <?php else: ?>    
    <div class="form-titre">
        <h2>Connection à <span class="carre-titre">Postgre</span><span class="titre-sql">SQL</span></h2>
    </div>
    <?php if(isset($error)): ?>
    <div class="error-box message-box">
        <p><?= $error ?></p>
    </div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-input">
            <label for="username">Pseudonyme : </label>
            <input type="text" name="username" placeholder="Testo">
        </div>
        <div class="form-input">
            <label for="password">Mot de passe : </label>
            <input type="password" name="password" placeholder="*****">
        </div>
        <div class="div-button">
            <button type="submit">Se connecter</button>
        </div>
    </form>
    <?php endif; ?>
</section>
<script>
    function addUser(e, form) {
        e.preventDefault();
        const formdata = new FormData(form);
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display ="none";
        }
        window.onclick = function(event) {
            if(event.target == modal) {
                modal.style.display = "none";
            }
        }
        fetch('addUser', {method: 'post', body: formdata})
            .then((response) => response.text()
            ).then(function(mytext){
                console.log(mytext);
                var boite = document.getElementById('message');
                boite.innerHTML = mytext;
                if (mytext === '<p>Utilisateur bien enregistré.</p>') {
                    boite.querySelector('p').style.backgroundColor = "#1db231";
                }
            }).catch((error) => {
                console.log(error);
            });
    }
    var ong1 = document.getElementById("article");
    var ong2 = document.getElementById("client");
    var ong3 = document.getElementById("commande");
    contenu = document.getElementById('content');
    function nonactive() {
        ong1.className = "";
        ong2.className = "";
        ong3.className = "";
    }
    function active(moi) {
        nonactive();
        moi.className="active";
    }
    ong1.addEventListener("click", function() {
        contenu.innerHTML = "article1";
        active(this);
    })
    ong2.addEventListener("click", function() {
        contenu.innerHTML = "article2";
        active(this);
    })
    ong3.addEventListener("click", function() {
        contenu.innerHTML = "article3";
        active(this);
    })
</script>