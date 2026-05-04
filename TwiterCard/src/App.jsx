import avatar from './avatar/avatar.jpg'

export function App () {
    return (
        <article className='tw-followCard'>
            <header className='tw-followCard-header'>
                <img 
                className='tw-followCard-avatar'
                alt='El avatar de midudev' 
                src={avatar} alt="Avatar"/>
                <div className='tw-followCard-info'>
                    <strong>Dario Aguiar Rodriguez</strong>
                    <span className='tw-followCard-infoUserName'>@dario</span>
                </div>
            </header>

            <aside>
                <button className='tw-followCard-button'>
                    Seguir
                </button>
            </aside>
        </article>
    )
}