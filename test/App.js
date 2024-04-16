import { useState, useEffect } from 'react'

const App = () => {
    const [quote, setQuote] = useState('výchozí text')
    const [loading, setLoading] = useState(true)
    const url = 'https://api.kanye.rest/'

    const getQuote = async () => {
        const response = await fetch(url)
        const data = await response.json()
        const finalQuote = data.quote;
        setQuote(finalQuote)
        setLoading(false)
    }

    useEffect( () => {
        getQuote()
    }, [])

    if (loading) {
        return <h1>Načítání dat...</h1>
    }


    return <div>
        <h2>{quote}</h2>
    </div>
}

export default App

