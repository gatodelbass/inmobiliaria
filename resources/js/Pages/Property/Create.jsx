import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { useForm } from "@inertiajs/react";

const Create = ({ auth, properties, types }) => {
  const { data, setData, post, processing, errors } = useForm({
    type: "",
    title: "",
    condition: "",
    cost: 0,
    discount: 0,
    description: "",
    address: "",
  });

  function submit(e) {
    e.preventDefault();
    post("/properties");
  }

  const handlerCargarArticulos = function (e) {
    const opcion = e.target.value;
    console.log(opcion);

    setIdArticulos(opcion);
  };

  return (
    <AuthenticatedLayout
      user={auth.user}
      header={
        <h2 className="font-semibold text-xl text-gray-800 leading-tight">
          Dashboard
        </h2>
      }
    >
      <Head title="Inmuebles" />

      {JSON.stringify(data)}

      <div className="max-w-4xl mx-auto mt-10 bg-amber-50 border-1">
        <form onSubmit={submit}>
          <div className="py-3 mx-auto sm:px-6 lg:px-8">
            <div className="flex justify-center py-4">
              <div className="flex bg-blueGray-800 rounded-full md:p-4 p-2 border-1 border-gray-300">
                <img src="bottleIcon" className="w-10" />
              </div>
            </div>
            <div className="flex justify-center mb-4">
              <div className="flex">
                <h1 className="text-gray-600 font-bold md:text-2xl text-xl">
                  Crear tipo de producto
                </h1>
              </div>
            </div>

            <div className="flex flex-wrap">
              <div className="w-full md:w-1/3 mb-4 px-2">
                <label for="name">Tipo: </label>

                <select
                  name="categorias"
                  id="selCategorias"
                  onChange={(e) => setData("type", e.target.value)}
                >
                  <option value={-1}>Seleccione una opción: </option>
                  {types.map((type) => (
                    <option key={type.id} value={type.id}>
                      {" "}
                      {type.type}
                    </option>
                  ))}
                </select>

                <jet-select id="" className="mt-1 block w-full" required />
                <input-error className="mt-2" />
              </div>
              <div className="w-full md:w-2/3 mb-4 px-2">
                <label for="name">Titulo: </label>
                <input
                  value={data.property}
                  onChange={(e) => setData("property", e.target.value)}
                  property="text"
                  className="mt-1 block w-full rounded-sm"
                />
                <input-error className="mt-2" />
              </div>

              <div className="w-full md:w-1/3 mb-4 px-2">
                <label for="name">Marca:</label>
                <jet-select id="" className="mt-1 block w-full" required />
                <input-error className="mt-2" />
              </div>

              <div className="w-full md:w-1/3 mb-4 px-2">
                <label for="name">Categoria:</label>
                <jet-select id="" className="mt-1 block w-full" required />
                <input-error className="mt-2" />
              </div>

              <div className="w-full md:w-1/3 mb-4 px-2">
                <label for="volume">Contenido (ml):</label>
                <input
                  id="volume"
                  property="number"
                  className="mt-1 block w-full"
                />
                <input-error className="mt-2" />
              </div>

              <div className="w-full md:w-1/3 mb-4 px-2">
                <label for="buy_cost">Precio compra:</label>
                <input
                  id="buy_cost"
                  property="number"
                  className="mt-1 block w-full"
                />
                <input-error className="mt-2" />
              </div>

              <div className="w-full md:w-1/3 mb-4 px-2">
                <label for="sell_cost">Precio venta:</label>
                <input
                  id="sell_cost"
                  property="number"
                  className="mt-1 block w-full"
                />
                <input-error className="mt-2" />
              </div>

              <div className="w-full md:w-1/3 mb-4 px-2">
                <label for="discount">Descuento:</label>
                <input
                  id="discount"
                  property="number"
                  className="mt-1 block w-full"
                  v-model="form.discount"
                />
                <input-error className="mt-2" />
              </div>

              <div className="w-full mb-4 px-2">
                <label for="notes">Notas:</label>
                <jet-text-area
                  id="notes"
                  className="mt-1 block w-full"
                  v-model="form.notes"
                ></jet-text-area>
                <input-error className="mt-2" />
              </div>

              <div className="w-full mb-4 px-2">
                <label for="notes">Imagen:</label>

                <div className="flex items-center justify-center w-full">
                  <label className="flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-gray-300 group">
                    <div className="flex flex-col items-center justify-center pt-7">
                      <svg
                        className="w-10 h-10 text-blueGray-500 group-hover:text-blueGray-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                        ></path>
                      </svg>
                      <p className="lowercase text-sm text-gray-400 group-hover:text-blueGray-600 pt-1 tracking-wider">
                        (400px x 600px)
                      </p>
                    </div>
                    <input property="file" className="hidden" />
                  </label>
                </div>

                <input-error className="mt-2" />
              </div>
            </div>
          </div>

          <div className="flex items-center justify-center px-4 mb-4 md:gap-8 gap-4">
            <a
              href={route("properties.index")}
              className="w-auto bg-blueGray-700 hover:bg-gray-600 rounded-sm shadow-xl font-medium text-amber-300 px-4 py-2"
            >
              Cancelar
            </a>
            <button
              property="submit"
              className="w-auto bg-teal-500 hover:bg-teal-600 rounded-sm shadow-xl font-medium text-blueGray-700 px-4 py-2"
            >
              Crear
            </button>
          </div>
        </form>
      </div>
    </AuthenticatedLayout>
  );
};

export default Create;
