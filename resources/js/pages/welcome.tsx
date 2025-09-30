import {PageWrapper} from "@/components/PageWrapper";
import {Container} from "@/components/Container";
import {Header} from "@/components/Header";
import {Search} from "@/components/Search";
import {ShortList} from "@/components/ShortList";
import {PuppiesList} from "@/components/PuppiesList";
import {NewPuppyForm} from "@/components/NewPuppyForm";
import {Suspense, use, useState} from "react";

import {Puppy} from "@/types";
import {getPuppies} from "@/queries";
import {LoaderCircle} from "lucide-react";
import {ErrorBoundary} from "react-error-boundary";

export default function App() {
    return (
        <PageWrapper>
            <Container>
                <Header/>
                <ErrorBoundary fallbackRender={({error}) => <p className={"text-red-500"}>{error.mesage}</p>}>
                    <Suspense fallback={<LoaderCircle className="animate-spin stroke-slate-300"/>}>
                        <Main/>
                    </Suspense>
                </ErrorBoundary>
            </Container>
        </PageWrapper>
    );
}

const puppyPromise = getPuppies();

function Main() {
    const apiPuppies = use(puppyPromise);
    const [searchQuery, setSearchQuery] = useState<string>("");
    const [puppies, setPuppies] = useState<Puppy[]>(apiPuppies);

    return (
        <main>
            <div className="mt-24 grid gap-8 sm:grid-cols-2">
                <Search searchQuery={searchQuery} setSearchQuery={setSearchQuery}/>
                <ShortList puppies={puppies} setPuppies={setPuppies} />
            </div>

            <PuppiesList searchQuery={searchQuery} puppies={puppies} setPuppies={setPuppies} />
            <NewPuppyForm puppies={puppies} setPuppies={setPuppies}/>
        </main>
    );
}
