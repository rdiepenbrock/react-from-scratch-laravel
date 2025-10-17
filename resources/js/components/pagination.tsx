import { PaginationLinks, PaginationMeta } from '@/types';
import { cn } from '@/lib/utils';
import { Button } from './ui/button';
import { Link } from '@inertiajs/react';
import { ChevronLeftIcon, ChevronRightIcon } from 'lucide-react';

type PaginationProps = {
    meta: PaginationMeta;
    links: PaginationLinks;
    className?: string;
};

export function Pagination({ meta, links, className } : PaginationProps ) {
    return (
        <div className={cn('flex items-center justify-between', className)}>
            <div>
                {links.prev && (
                    <Button variant="ghost" asChild>
                        <Link preserveScroll href={links.prev}>
                            <ChevronLeftIcon className="size-4" />
                            <span>Previous</span>
                        </Link>
                    </Button>
                )}
            </div>
            <p className="text-sm font-medium">
                Page { meta.current_page } of { meta.last_page }
            </p>
            <div>
                {links.next && (
                    <Button variant="ghost" asChild>
                        <Link preserveScroll href={links.next}>
                            <span>Next</span>
                            <ChevronRightIcon className="size-4" />
                        </Link>
                    </Button>
                )}
            </div>
        </div>
    );
}
