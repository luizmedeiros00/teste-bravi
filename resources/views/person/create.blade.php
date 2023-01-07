<html>

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
</head>

<body class=" bg-gray-100 dark:bg-gray-900 mt-10">
    <div class="lg:w-8/12 mx-auto w-full p-4">
        <div class="block p-6 rounded-lg shadow-lg bg-white">
            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Formulário</h5>
            <p class="text-gray-700 text-base mb-4">
            <form action="{{ route('person.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1">
                    <input type="hidden" name="id">
                    <x-input type="text" label="Nome" name="name" placeholder="Digite o seu nome" />
                    <x-input type="text" label="E-mail" name="email" placeholder="Digite o seu e-mail" />
                    <x-input type="text" label="Whatsapp" name="whatsapp" placeholder="Digite o Whatsapp" />
                    <x-input type="text" label="Telefone" name="phone" placeholder="Digite o seu telefone" />
                </div>
            </form>
            </p>
            <button id="submit-btn" type="submit"
                class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg">Cadastrar</button>
        </div>
    </div>
    <div class="p-4 w-full mx-auto">
        <div class="block p-6 rounded-lg shadow-lg bg-white">
            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">Lista</h5>
            <p class="text-gray-700 text-base mb-4">
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table id="myTable" class="min-w-full">
                                <thead class="border-b">
                                    <tr>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            #
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Nome
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            E-mail
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Whatsapp
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Telefone
                                        </th>
                                        <th scope="col"
                                            class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="tbodyTable">
                                    <tr class="border-b">

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </p>
        </div>
    </div>
    <script>
        $(function() {
            var notyf = new Notyf();

            async function load() {
                const {
                    data
                } = await axios.get('api/person')
                $("#myTable > tbody").empty()
                data.forEach(function(data) {
                    $("#myTable > tbody").append(
                        `<tr class='border-b'>
                          <td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>${data.id}</td>
                          <td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>${data.name}</td>
                          <td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>${data.email}</td>
                          <td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>${data.whatsapp}</td>
                          <td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>${data.phone}</td>
                          <td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>
                           <button data-id='${data.id}' class='btn-edit inline-block px-4 py-1.5 bg-blue-600 text-white rounded shadow-md hover:bg-blue-700 hover:shadow-lg'> Editar </button>
                           <button data-id='${data.id}' class="btn-delete inline-block px-4 py-1.5 bg-red-600 text-white rounded shadow-md hover:bg-red-700 hover:shadow-lg"> Deletar </button>
                            </td>
                          
                          </tr>`
                    );
                })

            }

            async function post(payload) {

                try {
                    const url = payload.id ? `api/person/${payload.id}` : 'api/person'
                    const method = payload.id ? 'put' : 'post'
                    const {
                        data
                    } = await axios[method](url, payload)
                    cleanForm()
                    notyf.success(data);
                } catch (error) {
                    const errors = error.response.data.errors
                    Object.keys(errors).forEach(item => {
                        errors[item].forEach(msg => {
                            notyf.error(msg);
                        })
                    })
                }
            }

            function cleanForm() {
                $("input[name='id']").val('')
                $("input[name='name']").val('')
                $("input[name='email']").val('')
                $("input[name='whatsapp']").val('')
                $("input[name='phone']").val('')
            }

            async function remove(id) {
                try {
                    const {
                        data
                    } = await axios.delete(`api/person/${id}`)
                    notyf.success(data);
                } catch (error) {
                    notyf.error('Não foi possível remover o item');
                }
            }

            async function get(id) {
                try {
                    const response = await axios.get(`api/person/${id}`)
                    return response
                } catch (error) {
                    notyf.error('Não foi possível pegar o item');
                }
            }

            $("#submit-btn").click(async function() {
                const payload = {
                    id: $("input[name='id']").val(),
                    name: $("input[name='name']").val(),
                    email: $("input[name='email']").val(),
                    whatsapp: $("input[name='whatsapp']").val(),
                    phone: $("input[name='phone']").val(),
                }
                await post(payload)
                await load()
            })

            $("#myTable").on('click', '.btn-edit', async function() {
                const id = $(this).data("id")
                const {
                    data
                } = await get(id)
                if (data) {
                    $("input[name='id']").val(data.id)
                    $("input[name='name']").val(data.name)
                    $("input[name='email']").val(data.email)
                    $("input[name='whatsapp']").val(data.whatsapp)
                    $("input[name='phone']").val(data.phone)
                }
            })

            $("#myTable").on('click', '.btn-delete', async function() {
                const id = $(this).data("id")
                await remove(id)
                await load()
            })

            load()
        });
    </script>
</body>

</html>
