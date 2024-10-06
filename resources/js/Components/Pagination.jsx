import { Link } from "@inertiajs/react";

export default function Pagination({ pagination }) {
    return (
        
        <nav className="mt-4">   

        {   pagination.links.map((link, index) => (
            <Link
                key={index}
                preserveScroll
                href={link.url || ""}
                className={`mt-4 px-3 py-2 text-sm rounded
                    ${ link.active ? "bg-gray-200" : "" }
                    ${ !link.url ? "!text-gray-300" : "" } `}
                    dangerouslySetInnerHTML = {{ __html: link.label }}
            />
        ))}
        </nav>
    );
}
