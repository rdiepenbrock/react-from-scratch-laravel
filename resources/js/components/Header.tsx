import { Link, usePage } from '@inertiajs/react';
import { SharedData } from '@/types';
import { Button } from '@/components/ui/button';

export function Header() {
    const { auth } = usePage<SharedData>().props;
    return (
        <header>
            {/* Logo */}
            <div className="item-center flex justify-between">
                <a className="group" href="/public">
                    <div className="inline-flex items-center gap-4">
                        <img
                            src="/images/logo.png"
                            alt="DevPups"
                            className="h-16 transition group-hover:scale-105 group-hover:-rotate-6 md:h-20 lg:h-24"
                        />
                        <p className="text-lg font-semibold">Dev Pups</p>
                    </div>
                </a>
            {/* auth actions */}
                {auth.user ?
                    <div className="flex items-center gap-4">
                        <p>Hi, {auth.user.name}</p>
                        <Button asChild>
                            <Link method="post" as="button" href={route('logout')}>Log Out</Link>
                        </Button>
                    </div>
                    : <Button asChild>
                        <Link href={route('login')}>Log In</Link>
                    </Button>
                }
            </div>
            {/* Hero copy */}
            <div className="mt-6">
                <h1 className="text-lg font-bold">
                    We've got the best puppies!
                </h1>
                <p className="text-slate-600">
                    Don't take our word — let the pictures do the talking :)
                </p>
                {!auth.user && (
                    <p className="text-slate-600">
                        <Link href={route('login')} className="underline hover:no-underline">Sign in</Link>{' '}
                        to keep track of your puppies!
                    </p>
                )}
            </div>
        </header>
    );
}
