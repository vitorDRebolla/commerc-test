<button><a href="/">Voltar</a></button>

<form action="/client" method="post">
    @csrf
    <div class="box">
        <label for="name">Nome</label>
        <input name="name" type="text">
    </div>

    <div class="box">
        <label for="email">Email</label>
        <input name="email" type="text">
    </div>

    <div class="box">
        <label for="phone">Telefone</label>
        <input name="phone" type="text">
    </div>

    <div class="box">
        <label for="date_of_birth">Data de nascimento (DD/MM/YYY)</label>
        <input name="date_of_birth" type="text">
    </div>

    <div class="box">
        <label for="address">Endereço</label>
        <input name="address" type="text">
    </div>

    <div class="box">
        <label for="complement">Complemento</label>
        <input name="complement" type="text">
    </div>

    <div class="box">
        <label for="neighborhood">Bairro</label>
        <input name="neighborhood" type="text">
    </div>

    <div class="box">
        <label for="cep">CEP</label>
        <input name="cep" type="text">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
</form>


<style>
    div {
        margin-bottom: 0.5rem;
        margin-top: 0.5rem;
    }

    div.box {
        display: flex;
        flex-direction: column;
    }

    a {
        text-decoration: none !important;
    }
</style>
