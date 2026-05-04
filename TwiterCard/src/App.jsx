import { TwiterFollowCard } from "./TwiterFollowCard";

export function App () {
    return (
        <>
        <TwiterFollowCard isFollowing userName='dario' name='Dario Aguilar Rodriguez'/>
        <TwiterFollowCard userName='rosa' name='Rosa Luque Rodriguez'/>
        <TwiterFollowCard userName='manolo' name='Manolo Perez Benitez'/>
        </>
    )
}