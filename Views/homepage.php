<section class="section-form">
    <?php if (isset($_SESSION['user']) and isset($_SESSION['password']) and ($_SESSION['superuser'] or $_SESSION['addrole'])) : ?>
    <div class="form-titre">
        <h2>Ajouter un utilisateur</h2>
    </div>
    <div id="message" class="error-box message-box">
    </div>
    <form action="" method="POST" onsubmit="addUser(event, this)">
        <div class="modal" id="myModal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 class="titre-modal">Paramètrage avancé</h2>
                <div class="superdroit">
                    <div class="checkbox">
                        <input type="checkbox" id="checkbox-superuser" name="superuser"
                            onchange="superuserchange(this)">
                        <label for="checkbox-superuser">SuperUser</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" id="checkbox-allowAddUser" name="allowAddUser">
                        <label for="checkbox-allowAddUser">Création d'utilisateur</label>
                    </div>
                </div>
                <ul>
                    <li class="ong1"><a id="article" class="active" href="#">Article</a></li>
                    <li class="ong2"><a id="client" href="#">Client</a></li>
                    <li class="ong3"><a id="commande" href="#">Commande</a></li>
                </ul>
                <div id="content1" class="ong1-form">
                    <div class="checkbox">
                        <input type="checkbox" name="allowShowArticle" id="allowShowArticle">
                        <label for="allowShowArticle">Consulter les articles</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="allowAddArticle" id="allowAddArticle"
                            onchange="selectArticle(this)">
                        <label for="allowAddArticle">Ajouter des articles</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="allowModifyArticle" id="allowModifyArticle"
                            onchange="selectArticle(this)">
                        <label for="allowModifyArticle">Modifier des articles</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="allowDeleteArticle" id="allowDeleteArticle"
                            onchange="selectArticle(this)">
                        <label for="allowDeleteArticle">Supprimer des articles</label>
                    </div>
                </div>
                <div id="content2" class="ong2-form">
                    <div class="checkbox">
                        <input type="checkbox" name="allowShowClient" id="allowShowClient">
                        <label for="allowShowClient">Consulter la liste client</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="allowAddClient" id="allowAddClient" onchange="selectClient(this)">
                        <label for="allowAddClient">Ajouter des clients</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="allowModifyClient" id="allowModifyClient"
                            onchange="selectClient(this)">
                        <label for="allowModifyClient">Modifier des informations client</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="allowDeleteClient" id="allowDeleteClient"
                            onchange="selectClient(this)">
                        <label for="allowDeleteClient">Supprimer des clients</label>
                    </div>
                </div>
                <div id="content3" class="ong3-form">
                    <div class="checkbox">
                        <input type="checkbox" name="allowShowCommande" id="allowShowCommande">
                        <label for="allowShowCommande">Consulter les commandes</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="allowAddCommande" id="allowAddCommande"
                            onchange="selectCommande(this)">
                        <label for="allowAddCommande">Ajouter des commandes</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="allowModifyCommande" id="allowModifyCommande"
                            onchange="selectCommande(this)">
                        <label for="allowModifyCommande">Modifier des commandes</label>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="allowDeleteCommande" id="allowDeleteCommande"
                            onchange="selectCommande(this)">
                        <label for="allowDeleteCommande">Supprimer des commandes</label>
                    </div>
                </div>
                <div class="modal-select">
                    <label for="group">Autorisation préremplie par role : </label>
                    <select name="group" multiple>
                        <option value="testo">testo</option>
                        <option value="testo">testo</option>
                    </select>
                </div>
                <div class="div-button">
                    <button type="submit">Finaliser</button>
                </div>
            </div>
        </div>
        <div class="form-input">
            <label for="username">Pseudonyme : </label>
            <input type="text" name="username" placeholder="Testo" required>
        </div>
        <div class="form-input">
            <label for="password">Mot de passe : </label>
            <input type="password" name="password" placeholder="*****" required>
        </div>
        <div class="div-button">
            <button id="myBtn" type="submit">Inscrire</button>
        </div>
        <div class="checkbox">
            <label for="more">Mode Avancé</label>
            <input id="more" type="checkbox" name="more" checked>
        </div>
    </form>
    <?php elseif (!isset($_SESSION['user']) or !isset($_SESSION['password'])) : ?>
    <div class="form-titre">
        <h2>Connection à <span class="carre-titre">Postgre</span><span class="titre-sql">SQL</span></h2>
    </div>
    <?php if (isset($error)) : ?>
    <div class="error-box message-box">
        <p><?= $error ?></p>
    </div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-input">
            <label for="username">Pseudonyme : </label>
            <input type="text" name="username" value="<?= $user ?? '' ?>" placeholder="Testo">
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
    <!-- <?php var_dump($_SESSION['permissions']); ?> -->
</section>
<script>
function addUser(e, form) {
    e.preventDefault();

    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
    var more = document.getElementById('more');
    if (more.checked == false) {
        const formdata = new FormData(form);
        fetch('addUser', {
                method: 'post',
                body: formdata
            })
            .then((response) => response.text()).then(function(mytext) {
                console.log(mytext);
                var boite = document.getElementById('message');
                boite.innerHTML = mytext;
                if (mytext === '<p>Utilisateur bien enregistré.</p>') {
                    boite.querySelector('p').style.backgroundColor = "#1db231";
                }
                modal.style.display = "none";
                more.checked = true;
            }).catch((error) => {
                console.log(error);
            });
    } else if (more.checked == true) {
        modal.style.display = "block";
        more.checked = false;

        span.onclick = function() {
            modal.style.display = "none";
            more.checked = true;
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                more.checked = true;
            }
        }
    }

}
var ong1 = document.getElementById("article");
var ong2 = document.getElementById("client");
var ong3 = document.getElementById("commande");
var contenu1 = document.getElementById('content1');
var contenu2 = document.getElementById('content2');
var contenu3 = document.getElementById('content3');

function nonactive() {
    ong1.className = "";
    ong2.className = "";
    ong3.className = "";
}

function active(moi) {
    nonactive();
    moi.className = "active";
}
ong1.addEventListener("click", function() {
    active(this);
    contenu1.style.display = "block";
    contenu2.style.display = "none";
    contenu3.style.display = "none";
})
ong2.addEventListener("click", function() {
    active(this);
    contenu1.style.display = "none";
    contenu2.style.display = "block";
    contenu3.style.display = "none";
})
ong3.addEventListener("click", function() {
    active(this);
    contenu1.style.display = "none";
    contenu2.style.display = "none";
    contenu3.style.display = "block";
})

function superuserchange(checkbox) {
    /* variable tableau qui contient tout les boutons a disabled mais sans enlever le comportement */
    var tableau = [document.getElementById('checkbox-allowAddUser')];
    tableau.push(document.getElementById('allowShowArticle'));
    tableau.push(document.getElementById('allowAddArticle'));
    tableau.push(document.getElementById('allowModifyArticle'));
    tableau.push(document.getElementById('allowDeleteArticle'));
    tableau.push(document.getElementById('allowShowClient'));
    tableau.push(document.getElementById('allowAddClient'));
    tableau.push(document.getElementById('allowModifyClient'));
    tableau.push(document.getElementById('allowDeleteClient'));
    tableau.push(document.getElementById('allowShowCommande'));
    tableau.push(document.getElementById('allowAddCommande'));
    tableau.push(document.getElementById('allowModifyCommande'));
    tableau.push(document.getElementById('allowDeleteCommande'));
    if (checkbox.checked == true) {
        tableau.forEach(function(element) {
            if (element.checked == false) {
                element.setAttribute("onclick", "return false");
                element.setAttribute("checked", "true");
            }

        });
    } else {
        tableau.forEach(function(element) {
            if (element.checked == true) {
                element.removeAttribute("onclick");
                element.removeAttribute("checked");
            }

        });
    }
}

function selectArticle(checkbox) {
    var defautArticle = document.getElementById("allowShowArticle");
    if (checkbox.checked == true && defautArticle.checked != true) {
        defautArticle.setAttribute("onclick", "return false");
        defautArticle.setAttribute("checked", "true");
    } else if (checkbox.checked == false && defautArticle.checked != false) {
        defautArticle.removeAttribute("onclick");
        defautArticle.removeAttribute("checked");
    }
}

function selectClient(checkbox) {
    var defautClient = document.getElementById("allowShowClient");
    if (checkbox.checked == true && defautClient.checked != true) {
        defautClient.setAttribute("onclick", "return false");
        defautClient.setAttribute("checked", "true");
    } else if (checkbox.checked == false && defautClient.checked != false) {
        defautClient.removeAttribute("onclick");
        defautClient.removeAttribute("checked");
    }
}

function selectCommande(checkbox) {
    var defautCommande = document.getElementById("allowShowCommande");
    if (checkbox.checked == true && defautCommande.checked != true) {
        defautCommande.setAttribute("onclick", "return false");
        defautCommande.setAttribute("checked", "true");
    } else if (checkbox.checked == false && defautCommande.checked != false) {
        defautCommande.removeAttribute("onclick");
        defautCommande.removeAttribute("checked");
    }
}
</script>