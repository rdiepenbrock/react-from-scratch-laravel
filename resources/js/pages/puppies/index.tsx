import {PageWrapper} from "@/components/PageWrapper";
import {Container} from "@/components/Container";
import {Header} from "@/components/Header";
import {Search} from "@/components/Search";
import {ShortList} from "@/components/ShortList";
import {PuppiesList} from "@/components/PuppiesList";
import {NewPuppyForm} from "@/components/NewPuppyForm";

import { Puppy, SharedData, Filters, PaginatedResponse } from '@/types';
import { usePage } from '@inertiajs/react';
import { useRef } from 'react';

export default function App({ puppies, likedPuppies, filters }: {
    puppies: PaginatedResponse<Puppy>,
    likedPuppies: Puppy[],
    filters: Filters })
{
    const { auth } = usePage<SharedData>().props;
    const mainRef = useRef<HTMLElement>(null);

    return (
        <PageWrapper>
            <Container>
                <Header />

                <main ref={mainRef} className="scroll-mt-6">
                    <div className="mt-24 grid gap-8 sm:grid-cols-2">
                        <Search filters={filters} />
                        { auth.user && <ShortList puppies={likedPuppies} /> }
                    </div>
                    <PuppiesList puppies={puppies} />
                    { auth.user && <NewPuppyForm mainRef={mainRef} /> }
                </main>

            </Container>
        </PageWrapper>
    );
}
