import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { Link } from "@inertiajs/react";

const Index = ({ auth, types }) => {
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

      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 text-center">
            <h1 className="text-lg font-semibold py-2">Tipos de inmuebles</h1>

            <Link
              as="button"
              className=" hover:underline mx-1 bg-teal-500 px-4 py-2 my-4 rounded-sm"
              href={route("types.create")}
            >
              Nuevo
            </Link>

            <div class="max-w-2xl mx-auto">
              <div class="flex flex-col">
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                  <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden my2">
                      <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700 text-base">
                        <thead class="bg-gray-800 ">
                          <tr class="text-teal-500">
                            <th scope="col" class="py-3 px-6  tracking-wider  ">
                              Tipo de inmueble
                            </th>
                            <th scope="col" class="py-3 px-6 tracking-wider  ">
                              Icono
                            </th>

                            <th scope="col" class="p-4">
                              <span class="sr-only">Edit</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                          {types.map((type) => (
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                              <td class="py-2 px-6  text-gray-900 whitespace-nowrap dark:text-white">
                                {type.type}
                              </td>
                              <td class="py-2 px-6  text-gray-500 whitespace-nowrap dark:text-white">
                                here icon
                              </td>

                              <td class="py-2 px-6   text-right whitespace-nowrap">
                                <a
                                  href="#"
                                  class="text-teal-400  hover:underline mx-1"
                                >
                                  Edit
                                </a>
                                <a
                                  href="#"
                                  class="text-red-400  hover:underline mx-1"
                                >
                                  Delete
                                </a>
                              </td>
                            </tr>
                          ))}
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
};

export default Index;
