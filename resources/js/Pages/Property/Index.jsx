import React from 'react'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';

const Index = ({auth, properties}) => {
  return (
    <AuthenticatedLayout
    user={auth.user}
    header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>}
>
    <Head title="Inmuebles" />

    <div className="py-12">mdf
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">dfg
            <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">seg
               {JSON.stringify(properties)}
            </div>
        </div>
    </div>
</AuthenticatedLayout>
  )
}

export default Index